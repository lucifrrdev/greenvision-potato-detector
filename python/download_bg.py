import os
import urllib.request
import ssl

def download_bg():
    print("=== Downloading Background / Non-Leaf Dataset ===")
    os.makedirs('dataset/Bukan_Daun_Kentang', exist_ok=True)
    
    # bypass ssl verification if needed
    ssl_context = ssl._create_unverified_context()
    
    count = 0
    # Picsum returns random photos of various objects
    for i in range(1, 301):
        try:
            url = "https://picsum.photos/256"
            filename = f"dataset/Bukan_Daun_Kentang/bukan_daun_{i}.jpg"
            
            # Download only if file doesn't exist
            if not os.path.exists(filename):
                req = urllib.request.Request(
                    url, 
                    headers={'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'}
                )
                with urllib.request.urlopen(req, context=ssl_context) as response, open(filename, 'wb') as out_file:
                    out_file.write(response.read())
                count += 1
                if count % 20 == 0:
                    print(f"Downloaded {count} images...")
            else:
                count += 1
        except Exception as e:
            print(f"Error downloading image {i}: {e}")
            
    print(f"Success! Total images in Bukan_Daun_Kentang: {count}")

if __name__ == "__main__":
    download_bg()
