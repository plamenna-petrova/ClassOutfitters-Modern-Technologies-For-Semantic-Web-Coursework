<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="description" content="Class Outfitters Template">
    <meta name="keywords" content="Class Outfitters, unica, creative, html">
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

<script src="js/fallWinterClothingCollection.js" type="module"></script>
</body>
</html>