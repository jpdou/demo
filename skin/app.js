/**
 * Created by jp.dou on 2018/8/18.
 */

var maskEl = $('#mask');

/* ---------------------------------------- Toolbar ---------------------------------------- */
var toolbarEl = $('.toolbar');
toolbarEl.find('.new-video').submit(function (e) {
    e.preventDefault();
    var form = e.currentTarget;
    $.post(
        form.action,
        {'identifier': $(form).find(':input[name=identifier]'), 'origin_href': $(form).find(':input[name=origin_href]')},
        function(data,status,xhr) {
            console.log(data);
        }
    );
});

/* ---------------------------------------- Video List ---------------------------------------- */
var videoListEl = $(".list");


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
var videoLikeButton = videoEl.find('.actions .like');
videoLikeButton.click(function () {
    var data = {'video_id' : window.video.id, 'cancel' : $(this).hasClass('active') ? 1 : 0};
    $.post(
        '/user/favorite/video/post',
        data,
        function(data,status,xhr) {
            videoLikeButton.toggleClass('active');
        }
    )
});

/* ---------------------------------------- Actress Detail Page ---------------------------------------- */
var actressEl = $('.actress-view');
// like
var actressLikeButton = actressEl.find('.actions .like');
actressLikeButton.click(function () {
    var data = {'actress_id' : window.actress_id, 'cancel' : $(this).hasClass('active') ? 1 : 0};
    $.post(
        '/user/favorite/actress/post',
        data,
        function(data,status,xhr) {
            actressLikeButton.toggleClass('active');
        }
    )
});