{** block-description:tmpl_instagram_feed **}
<div class="instagram-feed clearfix">
<div class="container-fluid">
    <ul class="feed-items">
{foreach $instagramfeed as $item}
    <li class="item"><a href="{$item.imgsrc}" class="" rel=""> <img src="{$item.imgsrc}" alt="{$item.title}"/></a></li>
{/foreach}
    </ul>
</div>
</div>

