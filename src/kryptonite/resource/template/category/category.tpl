{gc:extends file="main"/}
<h1 class="standalone-title">{$category->title}</h1>
<div class="page">
    {gc:foreach var="$enigmas" as="$enigma"}
        <div class="enigme-list stack twisted">
            <a href="{{url:kryptonite.enigma.enigma:$enigma->id,slugify($enigma->title)}}">
                <div class="content">
                    <div class="title">{$enigma->title}</div>
                    <div class="picture">
                        <img src="/{$enigma->logo}" alt="">
                    </div>
                </div>
            </a>
        </div>
    {/gc:foreach}
    <div class="clear"></div>
</div>