
if(document.getElementById("changeProfileImageLink")){
    document.getElementById("changeProfileImageLink").addEventListener("click", hideUnhideImageUpload);

}

// alert(typeof has_error);
function hideUnhideImageUpload(){

    var imageUploadSection = document.getElementById('imageUploadSection');
    if (imageUploadSection.classList.contains('show')) {
      imageUploadSection.classList.add('fade-out');
      imageUploadSection.classList.remove('show');
      document.getElementById("changeProfileImageLink").innerHTML = "Change image"
      document.getElementById("message").innerHTML = "";
      document.getElementById("fileInput").value = "";
    } else {
      imageUploadSection.classList.remove('fade-out');
      imageUploadSection.classList.add('fade-in', 'show');
      document.getElementById("changeProfileImageLink").innerHTML = "Cancel Upload"
    }
}

// here has_error coming from profile.php

// if(has_error){
//     if(has_error == true){
//         imageUploadSection.classList.add('fade-in', 'show');
//     } else if(has_error == false){
//         imageUploadSection.classList.add('fade-out');
//     }

// }



// File Upload
if(document.getElementById('fileUploadForm')){
    document.getElementById('fileUploadForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const fileInput = document.getElementById('fileInput');
        // const user_id = document.getElementById('user_id').value;
        const file = fileInput.files[0];

        
        // Validate file
        if (!file) {
            showError('Please select a file.');
            return;
        }
        // Validate file size (5MB limit)
        if (file.size > 5 * 1024 * 1024) {
            showError('File size exceeds the limit (5MB).');
            return;
        }

        // Validate file type
        const allowedFormats = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg+xml'];
        if (!allowedFormats.includes(file.type)) {
            showError('Invalid file format. Allowed formats: PNG, JPEG, SVG.');
            return;
        }

        const formData = new FormData();
        formData.append('file', file);

        fetch('profile_image_upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            data= JSON.parse(JSON.stringify(data))
            // showSuccess(data.message);
            document.getElementById("profileImage").src=`images/profile_image/${data}`
            document.getElementById("navProfileImage").src=`images/profile_image/${data}`
            document.getElementById("changeProfileImageLink").click();
            document.getElementById('message').innerHTML = "Upload Image";
            document.getElementById("fileInput").value = "";
        })
        .catch(error => {
            console.error('Error:', error);
            showError('An error occurred while uploading the file.');
        });

   
    });
}



function showError(message) {
    document.getElementById('message').innerHTML = `<div class="alert alert-danger">${message}</div>`;
}

function showSuccess(message) {
    document.getElementById('message').innerHTML = `<div class="alert alert-success">${message}</div>`;
}

