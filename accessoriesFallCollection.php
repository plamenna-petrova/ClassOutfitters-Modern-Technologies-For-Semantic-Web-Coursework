<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fall-Winter Cloting Collection 2023 / 2024</title>
</head>
<body>
<?php
    $classOutfittersXSL = new DOMDocument();
    $classOutfittersXSL->load('./xml/class-outfitters.xsl');
    $classOutfittersXSLTProcessor = new XSLTProcessor();
    $classOutfittersXSLTProcessor->importStylesheet($classOutfittersXSL);
    $classOutfittersXML = new DOMDocument();
    $classOutfittersXML->load('./xml/class-outfitters.xml');
    $processedAndTransformedXML = $classOutfittersXSLTProcessor->transformToXML($classOutfittersXML);
    echo $processedAndTransformedXML;
?>

<script>
    let fallWinterClothingCollectionColumns = document.querySelectorAll('.product__item__col.fall-winter-clothing-collection');

    for (let i = 0; i < fallWinterClothingCollectionColumns.length; i++) {
        fallWinterClothingCollectionColumns[i].remove();
    }
    
    let shoesWinterCollectionColumns = document.querySelectorAll('.product__item__col.shoes-winter-collection');

    for (let i = 0; i < shoesWinterCollectionColumns.length; i++) {
        shoesWinterCollectionColumns[i].remove();
    }
</script>

<script src="js/shop.js"></script>
</body>
</html>