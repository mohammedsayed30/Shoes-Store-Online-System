from lightfm import LightFM
from lightfm.data import Dataset
import joblib
import os

def build_dataset(products_df, interactions_df):
    try:
        dataset = Dataset()
        dataset.fit(
            users=interactions_df["user_id"].unique(),
            items=products_df["product_id"].unique()
        )

        # Build interaction matrix
        interactions, _ = dataset.build_interactions([
            (row["user_id"], row["product_id"])
            for _, row in interactions_df.iterrows()
        ])
        return dataset, interactions
    except Exception as e:
        print(f"Error during dataset building: {e}")
        return None, None


#train the model
def train_model(products_df, interactions_df, model_path="model.pkl"):
    """
    Always performs full training - creates new model every time.
    """
    dataset, interactions = build_dataset(products_df, interactions_df)
    model = LightFM(loss="warp")
    model.fit(interactions, epochs=2, num_threads=1)
    joblib.dump((model, dataset), model_path)
    return model, dataset


