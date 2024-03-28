$(document).ready(function () {
    $(document).on('submit', '#text_to_convert', function() {
        $.post($(this).attr('action'), $(this).serialize(), function (res) {
            $('#words_result').html(res.words);
            console.log('convert ...');
            // $.get("https://api.fastforex.io/fetch-one?from=PHP&to=USD&api_key={{ env('EXCHANGE_RATE_KEY') }}", $(this).serialize(), function (data) {
                    //     console.log('search');
                    //     $('#dollar_result').html(data.result.USD * res.num);
                    // });
                    $('#dollar_result').html(`PHP TO USD: ${11*res.num}`);
        });
        return false;
    });
    $(document).on('keyup', "input[type='text']", function () {
        $(this).parent().submit();
    });
});