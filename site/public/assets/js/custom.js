// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});
// Owl Carousel End..................

// Contact Sent

$('#contactSaveBtn').click(function(){
    var $name    = $('#contactNameId').val();
    var $mobile  = $('#contactMobileId').val();
    var $email   = $('#contactEmailId').val();
    var $message = $('#contactMessageId').val();

    contactSend($name, $mobile, $email, $message);
});

function contactSend(name, mobile, email, message)
{
    if(name == ''){
        $('#contactSaveBtn').html('আপনার নাম লিখুন');
        setTimeout(function(){
            $('#contactSaveBtn').html('পাঠিয়ে দিন');
        }, 5000);
    }else if(mobile == ''){
        $('#contactSaveBtn').html('আপনার মোবাইল নাম্বার লিখুন');
        setTimeout(function(){
            $('#contactSaveBtn').html('পাঠিয়ে দিন');
        }, 5000);
    }else if(email == ''){
        $('#contactSaveBtn').html('আপনার ইমেইল লিখুন');
        setTimeout(function(){
            $('#contactSaveBtn').html('পাঠিয়ে দিন');
        }, 5000);
    }else if(message == ''){
        $('#contactSaveBtn').html('আপনার মেসেজ লিখুন');
        setTimeout(function(){
            $('#contactSaveBtn').html('পাঠিয়ে দিন');
        }, 5000);
    }else{
        $('#contactSaveBtn').html('পাঠানো হচ্ছে...।');
        axios.post('contactSend',{
            name   : name,
            mobile : mobile,
            email  : email,
            message: message,
        })
        .then(function(response){
            if(response.status == 200){
                if(response.data == 1){
                    $('#contactSaveBtn').html('প্রসেস সম্পন্য হয়েছে !!');
                    setTimeout(function(){
                        $('#contactSaveBtn').html('পাঠিয়ে দিন');
                    }, 5000);
                }else{
                    $('#contactSaveBtn').html('প্রসেস ব্যার্থ্য হয়েছে !!');
                    setTimeout(function(){
                        $('#contactSaveBtn').html('পাঠিয়ে দিন');
                    }, 5000);
                }
            }else{
                $('#contactSaveBtn').html('একটি সমস্যা হয়েছে !!');
                setTimeout(function(){
                    $('#contactSaveBtn').html('পাঠিয়ে দিন');
                }, 5000);
            }
        })
        .catch(function(){
            $('#contactSaveBtn').html('একটি সমস্যা হয়েছে !!');
            setTimeout(function(){
                $('#contactSaveBtn').html('পাঠিয়ে দিন');
            }, 5000);
        })
    }

}
