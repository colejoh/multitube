angular.module('multitube', [

])
.controller('MainCtrl', function($scope) {
    $scope.lists = [
        {"id": 0, "name": "vlogs"},
        {"id": 1, "name": "tech"},
        {"id": 2, "name": "woodworking"},
    ];

    $scope.channels = [
            {"id": 0, "title": "Casey Neistat", "url": "https://youtube.com/user/caseyneistat", "list": "vlogs"},
            {"id": 1, "title": "MKBHD", "url": "https://www.youtube.com/user/marquesbrownlee", "list": "tech"},
            {"id": 2, "title": "Unbox Therapy", "url": "https://www.youtube.com/user/unboxtherapy", "list": "tech"},
            {"id": 3, "title": "Matthias Wandel", "url": "https://www.youtube.com/user/Matthiaswandel", "list": "woodworking"},
            {"id": 4, "title": "Linus Tech Tips", "url": "https://www.youtube.com/user/LinusTechTips", "list": "tech"},
            {"id": 5, "title": "Frank Howarth", "url": "https://www.youtube.com/user/urbanTrash", "list": "woodworking"},
    ];

    $scope.currentList = null;

    /**
    * Set current list assigns the global variable currentList to the current operating
    * list.
    * Parameters:
    *     list: The list to assign
    * Remarks:
    *     This function is used to filter the channels when selecting a list
    **/
    function setCurrentList(list) {
        $scope.currentList = list;
        cancelCreating();
        cancelEditing();
    }

    /**
    * Checks if the list passed through is the same is the current operating list
    * Parameters:
    *     list object to check
    * Returns:
    *     True if the list objects match, false otherwist
    **/
    function isCurrentList(list) {
        return $scope.currentList !== null && list.name == $scope.currentList.name;
    }

    $scope.setCurrentList = setCurrentList;
    $scope.isCurrentList = isCurrentList;

    //=============================
    //CRUD (Create, Update, Delete)
    //=============================

    /**
    * Resets the create form to default values
    **/
    function resetCreateForm() {
            $scope.newChannel = {
                title: '',
                url: '',
                list: $scope.currentList.name
            }
    }

    /**
    * Adds a channel object to the channel array
    * Parameters:
    *     channel: The channel object to add to the array
    * Remarks:
    *     The channel.id equal to length isn't a GREAT way to do it. It works
    *     though
    **/
    function createChannel(channel) {
        channel.id = $scope.channels.length;
        $scope.channels.push(channel);
        resetCreateForm();
    }

    $scope.createChannel = createChannel;
    $scope.editedChannel = null;

    function setEditedChannel(channel) {
        $scope.editedChannel = angular.copy(channel);
    }

    function updateChannel(channel) {
        var index = _.findIndex($scope.channels, function(b){
            return b.id == channel.id;
        })
        $scope.channels[index] = channel;
        $scope.editedChannel = null;
        $scope.isEditing = false;
    }

    $scope.setEditedChannel = setEditedChannel;
    $scope.updateChannel = updateChannel;
    //====================
    //Creating and Editing
    //====================
    $scope.isCreating = false;
    $scope.isEditing = false;

    /**
    * Assigns the global variables to the proper values to begin adding a channel
    * The function also resets all values using the resetCreateForm() method
    **/
    function startCreating() {
        $scope.isCreating = true;
        $scope.isEditing = false;
        resetCreateForm();
    }

    /**
    * This function is called when the user wants to cancel creating/adding
    **/
    function cancelCreating() {
        $scope.isCreating = false;
    }

    /**
    * Assigns the global variables to the proper values to begin editing a channel
    **/
    function startEditing() {
        $scope.isCreating = false;
        $scope.isEditing = true;
    }

    /**
    * This function is called when the user wants to cancel editing
    **/
    function cancelEditing() {
        $scope.isEditing = false;
    }

    /**
    * Function called under ng-if to check if it is allowed to show the creating form
    * Returns:
    *     True if the current list is set and the user isn't currently editing, false otherwise
    **/
    function shouldShowCreating() {
        return $scope.currentList && !$scope.isEditing;
    }

    /**
    * Function called under ng-if to check if it is allowed to show the editing form
    * Returns:
    *     True if the user wants to edit and the user currently isn't creating, false otherwise
    **/
    function shouldShowEditing() {
        return $scope.isEditing && !$scope.isCreating;
    }

    $scope.startCreating = startCreating;
    $scope.cancelCreating = cancelCreating;
    $scope.startEditing = startEditing;
    $scope.cancelEditing = cancelEditing;
    $scope.shouldShowCreating = shouldShowCreating;
    $scope.shouldShowEditing = shouldShowEditing;
})
