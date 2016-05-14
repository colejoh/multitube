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

    //Private function to filter the category based upon what the user selects
    function setCurrentList(list) {
        $scope.currentList = list;
        cancelCreating();
        cancelEditing();
    }

    //Private function to return if the current list is the list passed through
    function isCurrentList(list) {
        return $scope.currentList !== null && list.name == $scope.currentList.name;
    }

    $scope.setCurrentList = setCurrentList;
    $scope.isCurrentList = isCurrentList;

    //====================
    //Creating and Editing
    //====================
    $scope.isCreating = false;
    $scope.isEditing = false;

    function startCreating() {
        $scope.isCreating = true;
        $scope.isEditing = false;
    }

    function cancelCreating() {
        $scope.isCreating = false;
    }

    function startEditing() {
        $scope.isCreating = false;
        $scope.isEditing = true;
    }

    function cancelEditing() {
        $scope.isEditing = false;
    }

    function shouldShowCreating() {
        return $scope.currentList && !$scope.isEditing;
    }

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
