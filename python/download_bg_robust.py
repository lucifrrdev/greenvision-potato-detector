import os
import urllib.request
import ssl
import time

def download_bg():
    print("=== Downloading Background / Non-Leaf Dataset ===")
    target_dir = 'dataset/Bukan_Daun_Kentang'
    os.makedirs(target_dir, exist_ok=True)
    
    ssl_context = ssl._create_unverified_context()
    
    current_files = [f for f in os.listdir(target_dir) if f.endswith('.jpg')]
    print(f"Starting with {len(current_files)} files.")
    
    downloaded = len(current_files)
    i = 1
    while downloaded < 150:
        filename = f"{target_dir}/bukan_daun_{i}.jpg"
        if not os.path.exists(filename):
            try:
                url = "https://picsum.photos/256"
                req = urllib.request.Request(
                    url, 
                    headers={'User-Agent': 'Mozilla/5.0'}
                )
                with urllib.request.urlopen(req, context=ssl_context, timeout=5) as response:
                    with open(filename, 'wb') as out_file:
                        out_file.write(response.read())
                downloaded += 1
                if downloaded % 10 == 0:
                    print(f"Total downloaded files: {downloaded}/150")
                # Sleep a tiny bit to avoid rate limits
                time.sleep(0.1)
            except Exception as e:
                # If picsum fails or rate-limits, sleep and try again
                time.sleep(0.5)
        i += 1
            
    print(f"Done! Total files in Bukan_Daun_Kentang: {len(os.listdir(target_dir))}")

if __name__ == "__main__":
    download_bg()
