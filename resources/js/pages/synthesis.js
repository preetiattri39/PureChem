$(function () {
    window.enableCustomSynthesisSubmit = function () {
        $("#enable_custom_synthesis_submit_btn").prop("disabled", false);
    };

    try {
        ChemDoodle.ELEMENT['H'].jmolColor = 'black';
        ChemDoodle.ELEMENT['S'].jmolColor = '#B9A130';
        let sketcher = new ChemDoodle.SketcherCanvas('sketcher', 500, 300, {
            useServices: true,
            oneMolecule: false
        });
        sketcher.styles.atoms_displayTerminalCarbonLabels_2D = true;
        sketcher.styles.atoms_useJMOLColors = true;
        sketcher.styles.bonds_clearOverlaps_2D = true;
        sketcher.styles.shapes_color = 'c10000';
        sketcher.repaint();
    } catch (e) {
        $('#sketcher').html('<p style="color: red;">Sketcher not available - check ChemDoodle library</p>');
    }

    // Usage dropdown change handler
    const $usageSelect = $('#usage');
    const $usageOtherField = $('#usage-other-field');
    const $usageOtherInput = $('#usage_other');

    $usageSelect.on('change', function () {
        if ($(this).val() === 'other') {
            $usageOtherField.show();
            $usageOtherInput.attr('required', 'required');
        } else {
            $usageOtherField.hide();
            $usageOtherInput.removeAttr('required').val('');
        }
    });

    // Handle structure requirement toggle
    const structureFields = $('#structureFields');

    function toggleStructureFields() {
        if ($('#structureYes').is(':checked')) {
            structureFields.show();
        } else {
            structureFields.hide();
        }
    }

    $('#structureYes, #structureNo').on('change', toggleStructureFields);

    // Handle upload method toggle
    const imageUploadArea = $('#imageUploadArea');
    const canvasContainer = $('#canvasContainer');

    function toggleUploadMethod() {
        if ($('#uploadImage').is(':checked')) {
            imageUploadArea.show();
            canvasContainer.removeClass('active');
        } else {
            imageUploadArea.hide();
            canvasContainer.addClass('active');
        }
    }

    $('#uploadImage, #drawStructure').on('change', toggleUploadMethod);

    // Handle file upload
    const structureFile = $('#structureFile');
    const imageUploadDiv = $('#imageUploadArea');
    const uploadPlaceholder = $('#uploadPlaceholder');
    const imagePreview = $('#imagePreview');
    const previewImage = $('#previewImage');
    const removeImageBtn = $('#removeImage');

    imageUploadDiv.on('click', function (e) {
        if (e.target === structureFile[0]) {
            return;
        }

        if ($('#uploadImage').is(':checked')) {
            structureFile.click();
        }
    });

    structureFile.on('change', function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.attr('src', e.target.result);
                uploadPlaceholder.hide();
                imagePreview.show();
                imageUploadDiv.addClass('has-image');
            };
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.on('click', function (e) {
        e.stopPropagation();
        structureFile.val('');
        uploadPlaceholder.show();
        imagePreview.hide();
        imageUploadDiv.removeClass('has-image');
    });

    // Form submission
    const form = $('#custom-synthesis');
    const alertMessageSuccess = $('#global-success-message');
    const alertMessageError = $('#global-error-message');

    function showAlert(message, type) {
        if (type === 'success') {
            alertMessageSuccess.text(message);
            alertMessageSuccess.addClass('d-block');
            alertMessageSuccess.removeClass('d-none');
        } else {
            alertMessageError.text(message);
            alertMessageError.addClass('d-block');
            alertMessageError.removeClass('d-none');
        }
    }

    function alertBlockHide() {
        const alertMessage = $('.form-submission-status');
        alertMessage.removeClass('d-block');
        alertMessage.addClass('d-none');
    }

    form.on('submit', function (e) {
        e.preventDefault();

        $('#sh-loader').removeClass('d-none');
        alertBlockHide();

        const formData = new FormData(this);

        if ($('#drawStructure').is(':checked') && sketcher) {
            try {
                const canvasElement = $('#sketcher')[0];
                const canvasData = canvasElement.toDataURL('image/png');
                formData.append('canvas_data', canvasData);
            } catch (e) {
                console.error('Error capturing canvas:', e);
            }
        }

        $.ajax({
            method: 'POST',
            url: '/custom-synthesis/submit',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                if (data.success) {
                    showAlert(data.message, 'success');
                    form[0].reset();
                    uploadPlaceholder.show();
                    imagePreview.hide();
                    imageUploadDiv.removeClass('has-image');
                    // if (sketcher) {
                    //     sketcher.repaint();
                    // }
                    $('#structureYes').prop('checked', true);
                    $('#uploadImage').prop('checked', true);
                    toggleStructureFields();
                    toggleUploadMethod();
                    setTimeout(function () {
                        window.location.href = data.route;
                    }, 5000);
                    return;
                } else {
                    showAlert(data.message || 'An error occurred. Please try again.', 'error');
                    if (data.errors) {
                        console.error('Validation errors:', data.errors);
                    }
                }
            },
            error: function (err) {
                console.log(err);

                if (err.status === 401 && err.responseJSON && err.responseJSON.status === 'unauthenticated') {
                    showAlert(err.responseJSON.message, 'error');

                    var seconds = 5;

                    let timer = setInterval(() => {
                        seconds--;

                        showAlert(
                            `Please login before submitting the custom synthesis form. If not registered yet, go to the register page and signup. You will be redirected in ${seconds} seconds...`,
                            'error'
                        );

                        if (seconds === 0) {
                            clearInterval(timer); 
                             window.location.href = err.responseJSON.login_url;
                        }
                    }, 1000);

                    return;
                }

                const errorObj = err.responseJSON.errors;
                const firstKey = Object.keys(errorObj)[0];
                const firstError = errorObj[firstKey];
                showAlert(firstError, 'error');
            },
            complete: function () {
                $('#sh-loader').addClass('d-none');
            }
        })
    });

    toggleStructureFields();
    toggleUploadMethod();
});