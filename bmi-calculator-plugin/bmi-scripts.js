jQuery(document).ready(function($) {
    $('#calculate-bmi').click(function() {
        var height = $('#bmi-height').val();
        var weight = $('#bmi-weight').val();

        if (height === "" || weight === "") {
            $('#bmi-result').text('Please enter both height and weight.');
            return;
        }

        $.ajax({
            type: 'POST',
            url: bmi_ajax_obj.ajax_url,
            data: {
                action: 'calculate_bmi',
                height: height,
                weight: weight
            },
            success: function(response) {
                if (response.success) {
                    $('#bmi-result').html('Your BMI: <strong>' + response.data.bmi + '</strong><br>Category: <strong>' + response.data.category + '</strong>');
                } else {
                    $('#bmi-result').text(response.data);
                }
            }
        });
    });
});
