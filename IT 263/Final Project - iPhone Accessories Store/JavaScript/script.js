function passInput(accessory_id, filter, price) {
    var form = document.getElementById("purchaseA" + accessory_id + "F" + filter);

    // Check if the form is valid
    if (!form.checkValidity()) {
        // If the form is not valid, show validation messages and stop execution
        form.reportValidity();
        return false;
    }

    // Rest of your existing code...
    var quantity = document.getElementById("quantity-inputA" + accessory_id + "F" + filter).value;

    var modelSelect = document.getElementById("model-inputA" + accessory_id + "F" + filter);
    var modelId = modelSelect ? modelSelect.value : "";
    var modelText = modelSelect && modelSelect.selectedIndex > 0 ? modelSelect.options[modelSelect.selectedIndex].text : "";

    var colorSelect = document.getElementById("color-inputA" + accessory_id + "F" + filter);
    var colorId = colorSelect ? colorSelect.value : "";
    var colorText = colorSelect && colorSelect.selectedIndex > 0 ? colorSelect.options[colorSelect.selectedIndex].text : "";

    document.getElementById("quantity-checkoutA" + accessory_id + "F" + filter).value = quantity;

    var modelCheckout = document.getElementById("model-checkoutA" + accessory_id + "F" + filter);
    if (modelCheckout) {
        modelCheckout.value = modelId;
        document.getElementById("model-display-A" + accessory_id + "F" + filter).textContent = modelText || "N/A";
    }

    var colorCheckout = document.getElementById("color-checkoutA" + accessory_id + "F" + filter);
    if (colorCheckout) {
        colorCheckout.value = colorId;
        document.getElementById("color-display-A" + accessory_id + "F" + filter).textContent = colorText || "N/A";
    }

    // Calculate total without formatting
    var total = quantity * price;

    // Set the raw total value
    document.getElementById("total-checkoutA" + accessory_id + "F" + filter).value = total.toFixed(2);

    // Format total for display
    var formattedTotal = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(total);
    document.getElementById("total-display-A" + accessory_id + "F" + filter).textContent = formattedTotal;

    // Show the modal
    var accessoryModal = bootstrap.Modal.getInstance(document.getElementById("accessoryModalA" + accessory_id + "F" + filter));
    var checkoutModal = new bootstrap.Modal(document.getElementById("checkoutModalA" + accessory_id + "F" + filter));

    accessoryModal.hide();
    checkoutModal.show();

    return true;
}



// Add this new function to handle going back to the accessory modal
function backToAccessoryModal(accessory_id, filter) {
    var accessoryModal = new bootstrap.Modal(document.getElementById("accessoryModalA" + accessory_id + "F" + filter));
    var checkoutModal = bootstrap.Modal.getInstance(document.getElementById("checkoutModalA" + accessory_id + "F" + filter));

    checkoutModal.hide();
    accessoryModal.show();
}