/**
 * Created by Administrator on 2017/5/9.
 */

//推荐餐厅
//

$(function () {
    $('.fix-xq').width($('.canyinxq .col-md-4 img').width())
    window.onresize = function () {
        $('.fix-xq').width($('.canyinxq .col-md-4 img').width())
    }


    $('.canyinxq .col-md-4').mousemove(function () {

        $(this).find($('.fix-xq')).slideDown()
        $(this).find($('.fix-xq')).show()

    })

    $('.canyinxq .col-md-4').mouseleave(function () {
        $(this).find($('.fix-xq')).slideUp()


    })

    jQuery("#walk").slide({
        mainCell: ".bd ul12",
        effect: "top",
        autoPlay: true,
        trigger: "click",
        triggerTime: 0,
        delayTime: 1500,
        interTime: 5000
    });
})
