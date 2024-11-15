$(document).ready(function() {
    // Handle form submission via AJAX
    $('#updateForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Create a FormData object to handle file uploads and form data
        var formData = new FormData(this);

        $.ajax({
            url: '/api/updateProfile.php', // The API endpoint
            type: 'POST',
            data: formData,
            contentType: false,  // Required for file uploads
            processData: false,  // Required for file uploads
            success: function(response) {
                // Handle successful response
                console.log(response);

                try {
                    var jsonResponse = $.parseJSON(response);

                    if (jsonResponse.profile_picture && jsonResponse.bio) {
                        
                        swAlert("success", "Adatok sikeresen frissítve!", 2000);
                        
                    }
                    
                } catch (e) {
                    alert('Unexpected response format.');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                swAlert("error", "Hiba történt!", 2000);
                console.log('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
});