from PIL import Image
import os

files = [
    ('public/demirhan.png', 'public/demirhan.webp'),
    ('public/emirhan.jpeg', 'public/emirhan.webp')
]

for src, dest in files:
    if os.path.exists(src):
        try:
            with Image.open(src) as img:
                # Resize to 150px width, maintaining aspect ratio
                w, h = img.size
                new_w = 150
                new_h = int(h * (new_w / w))
                img = img.resize((new_w, new_h), Image.Resampling.LANCZOS)
                img.save(dest, 'WEBP', quality=85)
                print(f"Converted {src} to {dest}")
        except Exception as e:
            print(f"Error processing {src}: {e}")
    else:
        print(f"File not found: {src}")
