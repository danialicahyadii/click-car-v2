document.querySelector("#profile-foreground-img-file-input") && document.querySelector("#profile-foreground-img-file-input").addEventListener("change", function () {
    var preview = document.querySelector(".profile-wid-img");
    var fileInput = document.querySelector("#profile-foreground-img-file-input").files[0];
    var reader = new FileReader();
    
    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);
    
    if (fileInput) {
        reader.readAsDataURL(fileInput);
    }
});

document.querySelector("#profile-img-file-input") && document.querySelector("#profile-img-file-input").addEventListener("change", function () {
    var preview = document.querySelector(".user-profile-image");
    var fileInput = document.querySelector("#profile-img-file-input").files[0];
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var id = document.querySelector('#id').getAttribute('value');
    var formData = new FormData();
    formData.append('image', fileInput);
    formData.append('id', id);
    $.ajax({
        url: `/upload-profile-image/${id}`,
        method: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        contentType: false,
        processData: false,
        success: function (response) {
            Toastify({
                text: "Image uploaded successfully",
                duration: 3500,
                className: "success",
                position: "center", // `left`, `center` or `right`
            }).showToast();
            setTimeout(function() {
                window.location.reload();
            }, 3000);
        },
        error: function (xhr, status, error) {
            Toastify({
                text: "Error uploading image",
                duration: 3500,
                className: "danger",
                style: {
                    backgroundColor: "#f06548" // Warna merah
                },
                position: "center", // `left`, `center` or `right`
            }).showToast();
            setTimeout(function() {
                window.location.reload();
            }, 1000);
            console.error('Error uploading image:', error);
        }
    });
    var reader = new FileReader();
    
    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);
    
    if (fileInput) {
        reader.readAsDataURL(fileInput);
    }
});

var count = 2;

function new_link() {
    count++;
    var newDiv = document.createElement("div");
    var newContent = `
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-3">
                    <label for="jobTitle${count}" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="jobTitle${count}" placeholder="Job title">
                </div>
            </div>
            <!-- Other form fields go here -->
        </div>
    `;
    newDiv.innerHTML = newContent;
    document.getElementById("newlink").appendChild(newDiv);
    var triggers = document.querySelectorAll("[data-trigger]");
    Array.from(triggers).forEach(function (trigger) {
        new Choices(trigger, {
            placeholderValue: "This is a placeholder set in the config",
            searchPlaceholderValue: "This is a search placeholder",
            searchEnabled: false
        });
    });
}

function deleteEl(id) {
    var element = document.getElementById(id);
    document.getElementById("newlink").removeChild(element);
}
