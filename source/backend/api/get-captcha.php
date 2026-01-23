<?php
session_start();
header('Content-Type: image/svg+xml');
$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$captcha_code = substr(str_shuffle($chars), 0, 5);

$_SESSION['captcha_code'] = $captcha_code;

$width = 200;
$height = 60;

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<svg width="<?php echo $width; ?>" height="<?php echo $height; ?>" xmlns="http://www.w3.org/2000/svg">
    <rect width="100%" height="100%" fill="#f2f2f2"/>
    
    <?php for($i=0; $i<10; $i++): ?>
    <line x1="<?php echo rand(0, $width); ?>" y1="<?php echo rand(0, $height); ?>" 
          x2="<?php echo rand(0, $width); ?>" y2="<?php echo rand(0, $height); ?>" 
          stroke="#bbb" stroke-width="1.5" />
    <?php endfor; ?>

    <text x="50%" y="55%" font-family="Arial, sans-serif" font-size="28" font-weight="bold" fill="#333"
          dominant-baseline="middle" text-anchor="middle" letter-spacing="8">
        <?php echo $captcha_code; ?>
    </text>
</svg>