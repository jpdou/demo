/**
 * Created by jp.dou on 2018/8/18.
 */

var maskEl = $('#mask');

$('img').on('load', function () {
    $(this).addClass('loaded');
});

/* ---------------------------------------- Video List ---------------------------------------- */
var videoListEl = $(".list");
// $(document).ready(function () {
//     if (videoListEl.length > 0) {
//         var loading = false;
//         var load = function () {
//             var windowScrollTop = $(window).scrollTop();
//             var windowBottom = windowScrollTop + window.innerHeight;
//             var items = videoListEl.find(".item:not(.loaded)");
//             for(var i = 0; i < items.length; i++) {
//                 var item = $(items[i]);
//                 if (item.offset().top < windowBottom + 500) {
//                     var img = item.find('img');
//                     img.attr("src", img.data('src'));
//                 } else {
//                     break;
//                 }
//             }
//         };
//         load();
//         $(window).scroll(function () {
//             if (loading) {
//                 return;
//             }
//             loading = true;
//             load();
//             setTimeout(function () {
//                 loading = false;
//             }, 500);
//         })
//     }
// })


/* ---------------------------------------- Video Detail Page ---------------------------------------- */
var videoEl = $('.video');

var samplesContainerEl = videoEl.find('.samples');
var sampleViewer = videoEl.find("#samples-viewer");

// 放大 Sample
var closeSampleViewer = function () {
    sampleViewer.removeClass("active");
    maskEl.hide();
};

samplesContainerEl.find('.item').click(function () {
    sampleViewer.addClass('active');
    var ul = sampleViewer.find('ul');
    ul.html("");
    var clone = $(this).clone();
    clone[0].onclick = closeSampleViewer;
    ul.append(clone);
    ul.data("current", $(this).data("number"));
    maskEl.show();
});

sampleViewer.find('button.nav').click(function () {
    var sample;
    var ul = sampleViewer.find("ul");
    var max = samplesContainerEl.find("li").children().length - 1;
    var current = $(this).hasClass('prev') ? ul.data("current") - 1 : ul.data("current") + 1;

    //current = Math.min(Math.max(0, current), max);
    if (current > max) {
        current = current - max - 1;
    } else if (current < 0){
        current += (max + 1);
    }

    sample = samplesContainerEl.find('.item-' + current);
    var clone = sample.clone();
    clone[0].onclick = closeSampleViewer;
    ul.html("").append(clone);
    ul.data("current", current);
});

sampleViewer.find(".close").click(closeSampleViewer);

// like
var likeButton = videoEl.find('.actions .like');
likeButton.click(function (e) {
    var data = {'video_id' : window.video.id, 'cancel': $(this).hasClass('active') ? 1 : 0};
    $.post(
        '/user/favorite/video/post',
        data,
        function(data,status,xhr) {
            likeButton.toggleClass('active');
        }
    )
});