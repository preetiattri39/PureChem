$(function(){

    window.nextStep = () => {
        $('.step-1').addClass('d-none');
        $('.step-2').removeClass('d-none');
    }

    window.prevStep = ()=>{
        $('.step-2').addClass('d-none');
        $('.step-1').removeClass('d-none');
    }
    
    const $structureYes = $('#structureYes');
    const $structureNo = $('#structureNo');
    const $structureFields = $('#structureFields');
    const $uploadImage = $('#uploadImage');
    const $drawStructure = $('#drawStructure');
    const $imageUpload = $('.image-upload');
    const $canvasContainer = $('.canvas-container');
    const $existingYes = $('#existingCustomerYes');
    const $existingNo = $('#existingCustomerNo');
    const $existingCustomerFields = $('#existingCustomerFields');
    const $newCustomerFields = $('#newCustomerFields');

    function toggleStructureFields() {
        if ($structureYes.is(':checked')) {
            $structureFields.removeClass('d-none');
        } else {
            $structureFields.addClass('d-none');
        }
    }

    function toggleUploadMethod() {
        if ($uploadImage.is(':checked')) {
            $imageUpload.removeClass('d-none');
            $canvasContainer.addClass('d-none');
        } else if ($drawStructure.is(':checked')) {
            $canvasContainer.removeClass('d-none');
            $imageUpload.addClass('d-none');
        }
    }

    function toggleCustomerFields() {
        if ($existingYes.is(':checked')) {
            $existingCustomerFields.removeClass('d-none');
            $newCustomerFields.addClass('d-none');
        } else if ($existingNo.is(':checked')) {
            $existingCustomerFields.addClass('d-none');
            $newCustomerFields.removeClass('d-none');
        }
    }

    $structureYes.on('change', toggleStructureFields);
    $structureNo.on('change', toggleStructureFields);
    $uploadImage.on('change', toggleUploadMethod);
    $drawStructure.on('change', toggleUploadMethod);
    $existingYes.on('change', toggleCustomerFields);
    $existingNo.on('change', toggleCustomerFields);

    // Initial toggle setup
    toggleStructureFields();
    toggleUploadMethod();
    toggleCustomerFields();

});