/**
 * Created by JacksonM on 2016-12-23.
 */

/**
 * this section closes a modal
 */
var closeModal = function(){
    $('.modal').css("display","none");
};

/**
 * this section opens the modal
 */
$('body').on('click','.open-modal',function () {
    $('.modal').css("display","block");
});

/**
 * this section closes the modal
 */
$('body').on('click','.modal-close',function () {
    $('.modal').css("display","none");
});


