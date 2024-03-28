$(document).ready(function () {
    $(document).on('submit', '#text_to_convert', function() {
        $.post($(this).attr('action'), $(this).serialize(), function (res) {
            $('#words_result').html(res.words);
            console.log('convert ...');
            $.get(`https://api.fastforex.io/fetch-one?from=PHP&to=USD&api_key=${erk}`, $(this).serialize(), function (data) {
                $('#dollar_result').html(`PHP TO USD: ${data.result.USD * res.num}`);
            });
        });
        return false;
    });
    $(document).on('keyup', "input[type='text']", function () {
        $(this).parent().submit();
    });
});