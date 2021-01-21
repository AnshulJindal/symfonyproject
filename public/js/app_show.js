function likeanddislike(id,dir)
{
    $.ajax({
        url: '/answer/'+id+'/vote/'+dir
    }).then(function(data) {
        console.log(data);
        $('.'+id).text(data.votes+" Votes");
    });
}