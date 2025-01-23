document.addEventListener("DOMContentLoaded", function () {
    const addGroupButton = document.getElementById("add-group");
    const groupSelect = document.getElementById("group-select");
    const selectedGroupsList = document.getElementById("selected-groups-list");
    const groupIdsInput = document.getElementById("group-ids");

    // Add a group to the list
    addGroupButton.addEventListener("click", function () {
        const groupId = groupSelect.value;
        const groupName = groupSelect.options[groupSelect.selectedIndex].text;

        if (!groupId) {
            alert("Please select a group!");
            return;
        }

        // Check if the group is already added
        const existingGroups = Array.from(
            selectedGroupsList.querySelectorAll("li")
        ).map((li) => li.dataset.groupId);
        if (existingGroups.includes(groupId)) {
            alert("Group already selected!");
            return;
        }

        // Create a list item for the group
        const li = document.createElement("li");
        li.dataset.groupId = groupId;
        li.textContent = groupName;

        // Add a "Remove" button to the group
        const removeButton = document.createElement("button");
        removeButton.textContent = "Remove";
        removeButton.style.marginLeft = "10px";
        removeButton.style.marginTop = "3px";
        removeButton.style.backgroundColor = "#007bff";
        removeButton.style.color = "#fff";
        removeButton.style.fontSize = "10px";
        removeButton.style.borderRadius = "2px";
        removeButton.style.padding = "10px 15px";
        removeButton.style.cursor = "pointer";
        removeButton.style.border = "none";
        removeButton.addEventListener("click", function () {
            li.remove(); // Remove the list item
            updateHiddenInput(); // Update the hidden input
        });
        li.appendChild(removeButton);

        // Add the list item to the group list
        selectedGroupsList.appendChild(li);

        // Update the hidden input
        updateHiddenInput();
    });

    // Update the hidden input with the current group IDs
    function updateHiddenInput() {
        const selectedGroupIds = Array.from(
            selectedGroupsList.querySelectorAll("li")
        ).map((li) => li.dataset.groupId);
        groupIdsInput.value = selectedGroupIds.join(",");
    }
});
