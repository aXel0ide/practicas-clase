from pathlib import Path
from PIL import Image
from cairosvg import svg2png

base = Path(r'c:/xampp/htdocs/practicas-clase/proyecto_1_web-tienda-friki/assets/img/banners')
for svg_path in base.glob('*.svg'):
    png_path = svg_path.with_suffix('.png')
    svg2png(url=str(svg_path), write_to=str(png_path), dpi=180)
    img = Image.open(png_path).convert('RGB')
    jpg_path = svg_path.with_suffix('.jpg')
    img.save(jpg_path, quality=95)
    print(f'Created {jpg_path}')
