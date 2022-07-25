window.onload = function () {
    // Change avatar profile
    $("#us-change-avatar").change(function () {
        $("#us-form").submit();
    })
    // Topics - form change, filtering and sorting
    $('input[type=radio][name=pagination], #sort-topic').change(function() {
        $("#topic-form").submit();
        $("#responses-form").submit();
    })
    $("#search-topic-icon").click(function () {
        $("#topic-form").submit();
    })
    $('#sort-topic-icon').click(function () {
        topic.changeSortDirection();
        $("#topic-form").submit();
    })
    // Thread - add image
    $("#thread-images-preview-add").on("change", ".thread-add-image", function () {
        thread.showPendingImage(this);
    })
    $(".thread-add-image").change(function (e) {
        e.stopImmediatePropagation();
        thread.showPendingImage(this);
    })
    // Thread - remove image
    $("#thread-images-preview-add").on("click", ".cancel-image", function () {
        thread.removePendingImage(this);
    });
    // Replies - open image
    $('.rcm-image').click(function () {
        thread.openImage(this);
    })
    // Replies - remove image from database
    $('.edit-remove-image').click(function () {
        replyEdit.deleteImage(this);
    })
    // Open full screen
    $(".full-page-cover").click(function () {
        thread.closeQuickView();
    })
    $("#close-full-page").click(function () {
        thread.closeQuickView();
    })
    $("#full-page-cover-image").click(function (e) {
        e.stopPropagation();
    })
    // Search
    $("#nav-search-input").keyup(function () {
        search.instantResults(this);
    })
    $("#nav-search-results").click(function(e) {
        e.stopPropagation();
    });
    $(document).click(function() {
        $('#nav-search-results').slideUp();
    });
    // Panel search
    $("#panel-search-topics").keyup(function () {
        adminPanel.searchTopics(this);
    })
    $("#panel-search-threads").keyup(function () {
        adminPanel.searchThreads(this);
    })
}

const form = (() => {
    const inputFieldsAndRegexRules =
        [{field: "username", regex: [/^[\w]{2,30}$/], errorMessage: "Username can only contain letters, numbers and '_' character. Minimum length is 2 and maximum is 30."}, {field: "email", regex: [/^[a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4})+$/], errorMessage: "Icorrect email form. Example: name.surname@email.com"}, {field: "password", regex: [/^.{5,}$/, /[a-z]|[A-Z]/, /[0-9]/], errorMessage: "Password must contain minimum 5 characters with at least one letter and one number."}, {field: "location", regex: [/^([A-z\d\s,.]{3,60}|)$/], errorMessage: "Location can only contain letters, numbers, spaces, coma and dot characters between 3 and 60 in length."}, {field: "signature", regex: [/^([A-z\d\s\W]{3,150}|)$/], errorMessage: "Signature can contain letters, numbers, spaces and non-word characters betweeen 3 and 150 in length."}, {field: "title", regex: [/^[A-z\d\s\W]{2,200}$/], errorMessage: "Title must be between 2 and 200 characters in length."}, {field: "text", regex: [/^[A-z\d\s\W]{2,1000}$/], errorMessage: "Reply must be beetween 2 and 1000 characters in length."}, {field: "tname", regex: [/^[A-z0-9 ]{2,255}$/], errorMessage: "Topic title can only contain letters and numbers between 2 and 250 characters in length."}];

    const validateMultipleFields = (fieldsArray, formType, previousTests) => {
        var inputFields = form.getFieldsForValidation(fieldsArray);

        var didAllPass = true;
        for (var input of inputFields) {
            var currentInputValue = $("#"+formType+"-"+input.field).val();
            var regexValues = input.regex;
            var inputErrorField = $("#"+formType+"-"+input.field + "-info");

            var didSinglePass = true;
            for (var singleRegex of regexValues) {
                if(!singleRegex.test(currentInputValue)) {
                    didAllPass = false;
                    didSinglePass = false;
                    inputErrorField.css("display", "flex");
                    inputErrorField.children("span").text(input.errorMessage);
                }
            }
            if(didSinglePass) {
                inputErrorField.css("display", "none");
            }
        }

        if (previousTests === false) {
            return false;
        }
        else return didAllPass;
    }
    const getFieldsForValidation = (wantedFields) => {
        var search;
        if(Array.isArray(wantedFields)) {
            search = [];
            for (var field of wantedFields) {
                var searchedField = inputFieldsAndRegexRules.find(i => i.field == field);
                if (searchedField != undefined) search.push(searchedField);
            }
        }
        else {
            search = inputFieldsAndRegexRules.find(i => i.field == wantedFields);
        }

        return search;
    }
    return { validateMultipleFields, getFieldsForValidation }
})();
const search = (() => {
    const instantResults = (element) => {
        var value = $(element).val();
        if (value == "") $("#nav-search-results").slideUp();
        else $("#nav-search-results").slideDown();
        console.log(value);

        $.ajax({
            method: "post",
            datatype: "json",
            url: "/ajaxsearchthreads",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                keyword: value
            },
            success: function (threads) {
                var threads = JSON.parse(threads);
                console.log(threads)

                html = "";
                for (var thread of threads) {
                    html += `<li><a href="thread/${thread.id}">${thread.title}</a></li>`;
                }

                $("#nav-search-results").html(html);
            },
            error: function () {

            }
        })

    }

    return { instantResults }
})();
const register = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["username", "email", "password"], "register", didAllTestsPass);

        /* Check if passwords match */
        var passwordFirstField = $("#register-password");
        var passwordSecondField = $("#register-confirm-password");
        var passwordCheckErrorField = $("#register-confirm-password-info");

        if (passwordFirstField.val() != passwordSecondField.val()) {
            var didAllTestsPass = false;
            passwordCheckErrorField.css("display", "flex");
            passwordCheckErrorField.children("span").text("Passwords do not match");
        }

        return didAllTestsPass;
    }

    return { validate }
})();
const login = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["email", "password"], "login", didAllTestsPass);

        return didAllTestsPass;
    }
    return { validate }
})();
const updateUser = (() => {
    const validate = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["username", "email", "location", "signature"], "update", didAllTestsPass);

        return didAllTestsPass;
    }

    return { validate }
})();
const topic = (() => {
    const changeSortDirection = () => {
        var value = $("#topics-sort-dir").val();

        if (value == "asc") {
            $("#topics-sort-dir").val("desc");
            $("#sort-topic-icon").css("transform", "rotate(0deg)");
        }
        else {
            $("#topics-sort-dir").val("asc");
            $("#sort-topic-icon").css("transform", "rotate(180deg)");
        }
    }
    const validateEditingTopic = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["tname"], "topic", didAllTestsPass);

        return didAllTestsPass;
    }

    return { changeSortDirection, validateEditingTopic }
})();
const thread = (() => {
    var currentImageCounter = 1;

    const validateAddingThread = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["title", "text"], "thread", didAllTestsPass);

        return didAllTestsPass;
    }
    const validateAddingReply = () => {
        var didAllTestsPass = true;
        didAllTestsPass = form.validateMultipleFields(["text"], "thread", didAllTestsPass);

        return didAllTestsPass;
    }
    const showPendingImage = (input) => {
        const reader = new FileReader();
        reader.addEventListener('load', () => {
            var uploaded_image = reader.result;

            var html = `
                <div class="image-preview-wrapper" data-serial="${currentImageCounter}">
                    <div class="image-preview" style="background-image: url(${uploaded_image})" data-serial="${currentImageCounter}"></div>
                    <div class="cancel-image" data-serial="${currentImageCounter}">X</div>
                </div>
            `;
            $("#image-previews").append(html);
            addNewImageInput();
        });
        reader.readAsDataURL(input.files[0]);
    }
    const addNewImageInput = () => {
        currentImageCounter++;
        $("#add-new-image").remove();
        html = `<input type="file" id="add-image${currentImageCounter}" class="thread-add-image" name="images[]" data-serial="${currentImageCounter}">
        <label id="add-new-image" for="add-image${currentImageCounter}">+</label>
`;
        $("#thread-images-preview-add").append(html);
    }
    const removePendingImage = (element) => {
        var serial = $(element).data('serial');
        $(`.image-preview-wrapper[data-serial='${serial}']`).remove();
        $(`input[data-serial='${serial}']`).remove();
    }
    const openImage = (element) => {
        var name = $(element).data('name');
        $(".full-page-cover").css("display", "flex");
        $("#full-page-cover-image").attr("src", window.location.origin+'/assets/img/'+name);
    }
    const closeQuickView = () => {
        $(".full-page-cover").css("display", "none");
    }

    return { validateAddingThread, validateAddingReply, showPendingImage, removePendingImage, openImage, closeQuickView }
})();
const replyEdit = (() => {
    const deleteImage = (element) => {
        var responseImageId = $(element).data('id');

        $.ajax({
            method: "post",
            datatype: "json",
            url: "/reply/removeImage",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: responseImageId
            },
            success: function () {
                alert('Image deleted');
                $(".image-preview-wrapper[data-id='" + responseImageId + "']").hide();
            },
            error: function () {

            }
        })
    }

    return { deleteImage }
})();
const adminPanel = (() => {
    const searchTopics = (element) => {
        var keyword = $(element).val();

        $.ajax({
            method: "post",
            datatype: "json",
            url: "/adminsearchtopics",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                keyword: keyword
            },
            success: function (topics) {
                topics = JSON.parse(topics);
                console.log(topics);
                var html = "";

                for (var topic of topics) {
                    html += `
                        <tr>
                            <td><a href="${topic.link}">${topic.general.name}</a></td>
                            <td>${topic.countThreads}</td>
                            <td>${topic.countPosts}</td>
                            <td>${topic.general.views}</td>
                            <td><button class="admin-option-button admin-edit"><a href="/topic/edit/${topic.general.id}">Edit</a></button></td>
                            <td><button class="admin-option-button admin-delete"><a href="/topic/remove/${topic.general.id}">Delete</a></button></td>
                        </tr>
                    `;
                }

                $("#table-body").html(html);
            },
            error: function () {

            }
        })
    }
    const searchThreads = (element) => {
        var keyword = $(element).val();
        $.ajax({
            method: "post",
            datatype: "json",
            url: "/adminsearchthreads",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                keyword: keyword
            },
            success: function (threads) {
                threads = JSON.parse(threads);
                console.log(threads);
                var html = "";

                for (var thread of threads) {
                    html += `
                        <tr>
                            <td><a href="/thread/${thread.threadId}">${thread.title}</a></td>
                            <td>${thread.topicName}</td>
                            <td>${thread.countReplies}</td>
                            <td>${thread.threadViews}</td>
                            <td><button class="admin-option-button admin-edit"><a href="/thread/edit/${thread.threadId}">Edit</a></button></td>
                            <td><button class="admin-option-button admin-delete"><a href="/thread/remove/${thread.threadId}">Delete</a></button></td>
                        </tr>
                    `;
                }

                $("#table-body").html(html);
            },
            error: function () {

            }
        })
    }

    return { searchTopics, searchThreads }
})();
