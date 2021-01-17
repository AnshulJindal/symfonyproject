var $container = $('.js-vote-arrows');
$container.find('button').on('click', function(e) {
    e.preventDefault();
    var $link = $(e.currentTarget);
    $.ajax({
        url: '/comments/10/vote/'+$link[0].attributes[2].nodeValue,
        method: 'POST'
    }).then(function(data) {
        
        $container.find('.js-vote-total').text(data.votes);
    });
});