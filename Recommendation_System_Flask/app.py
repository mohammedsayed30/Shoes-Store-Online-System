from flask import Flask, jsonify
import joblib
from data_training import fetch_products, fetch_interactions
from train_model import train_model

app = Flask(__name__)

@app.route("/check")
def check():
    products_df = fetch_products()
    interactions_df = fetch_interactions()
     #return the first 5 rows of products and interactions for verification
    return jsonify({
        "products": products_df.head().to_dict(orient="records"),
        "interactions": interactions_df.head().to_dict(orient="records")
    })

@app.route("/")
def index():
    return jsonify({"message": "Welcome to the Recommendation System API"})

@app.route("/train", methods=["POST"])
def train():
    products_df = fetch_products()
    interactions_df = fetch_interactions()
    train_model(products_df, interactions_df)
    return jsonify({"message": "The Model Got Trained "})



@app.route("/recommend/<int:user_id>",methods=["GET"])
def recommend(user_id):
    model, dataset = joblib.load("model.pkl")
    
        # Get mappings - correct indices
    user_map = dataset.mapping()[0]  # user mappings
    item_map = dataset.mapping()[2]  # item mappings

    if user_id not in user_map:
        return jsonify({"error": "No recommendations available for this user"})
    
    internal_user_id = user_map[user_id]
    
    # Get all internal item IDs
    internal_item_ids = list(item_map.values())
    
    # Predict scores for all items
    scores = model.predict(internal_user_id, internal_item_ids)
    scores = scores.tolist()  # Convert to list for JSON serialization
  
   
      # Create reverse mapping - convert numpy.int64 to regular int
    reverse_item_map = {int(internal_id): int(original_id) for original_id, internal_id in item_map.items()}
    
    # Create scored items list
    scored_items = [
        (reverse_item_map[internal_id], float(score))
        for internal_id, score in zip(internal_item_ids, scores)
    ]
    
    # Sort by score (descending) and take top 2
    top_items = sorted(scored_items, key=lambda x: x[1], reverse=True)[:30]

    # Extract only the item IDs (without scores)
    recommendations = [item[0] for item in top_items]
    
    return jsonify({"recommendations": recommendations})


if __name__ == "__main__":
    app.run(port=5000, debug=False)
