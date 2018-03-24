<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
    <loc>https://www.domain.com/</loc>
</url>
<?php foreach($products as $product): ?>
<url>
    <loc>https://www.domain.com/shop/<?php echo $product->slug; ?></loc>
</url>
<?php endforeach; ?>
</urlset>
