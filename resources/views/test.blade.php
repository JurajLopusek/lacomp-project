<x-layouts.base>
    <?php
        $text = 'hodnota1=2205&hodnota2=-1200';
        $text2 = 'id=00650001D&eled=40167272&elen=0&pln=1864180&vod=404696&tepvn=1677721604.06.2024 14:48:25';
        $ttj = new \App\Http\Controllers\TextToJson();

        dump($ttj->textToJson($text));
        dump($ttj->textToJson($text2));
    ?>
</x-layouts.base>
