import requests
import pandas as pd

#the base URL of the main system API to get the required data
DATA_BASE_URL = "http://localhost/BootUp/public/api/v1"

# Fetching the products data
def fetch_products():

     r = requests.get(f"{DATA_BASE_URL}/train/products")
     r.raise_for_status()
     data = r.json()
    
     products = data.get("products", [])
    
    # Keep all product features, flattening nested lists into columns
     products_df = pd.json_normalize(products)
    
    # Rename 'id' to 'product_id' if needed for consistency
     products_df.rename(columns={"id": "product_id"}, inplace=True)
    
     return products_df
 


# Fetching the users interactions made on that products
def fetch_interactions():

     r = requests.get(f"{DATA_BASE_URL}/user/interactions")
     r.raise_for_status()
     data = r.json()
     interactions = data.get("interactions", [])
     interactions_df = pd.json_normalize(interactions)
     # Make sure columns are: user_id, product_id
     return interactions_df

