app.controller('SiteController', function ($scope, $http, API_URL, SUCCESS_CODE,Helper) {
        $scope.theTime = '00:06:00';
        Helper.timer.run(function (h, m, s) {
            $scope.theTime = '' + h + ':' + m + ':' + s;
        });
        //retrieve user listing from API
        $http.get(API_URL + "user").then(function (response) {
            if (response.data.code === SUCCESS_CODE) {
                $scope.users = response.data.result;
            }
        }, function (error) {
            console.log(error);
        });

        //show modal form
        $scope.toggle = function (modalstate, key) {
            $scope.modalstate = modalstate;

            switch (modalstate) {
                case 'add':
                    $scope.form_title = "Add New User";
                    $scope.user = null;
                    break;
                case 'update':
                    $scope.user = $scope.users[key];
                    $scope.form_title = "User Detail";
                    $scope.id = $scope.user.id;
                    $scope._index = key;
                    break;
                default:
                    break;
            }
            $('#myModal').modal('show');
        };

        //save new record / update existing record
        $scope.save = function (modalstate, id, key) {
            var url = API_URL + "user/create";

            //append employee id to the URL if the form is in update mode
            if (modalstate === 'update') {
                url = API_URL + "user/update/" + id;
            }

            $http({
                method: 'POST',
                url: url,
                data: window.heler.param($scope.user),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function (response) {
                console.log(response);
                if (response.data.code === SUCCESS_CODE) {
                    if (modalstate === 'update') {
                        $scope.users[key] = response.data.result;
                    } else {
                        $scope.users.push(response.data.result);
                    }
                    alert(response.data.message);
                    $('#myModal').modal('hide');
                } else {
                    alert(response.data.message);
                }
            }, function (response) {
                console.log(response);
            });
        };

        //show delete record
        $scope.showDelete = function (id, key) {
            $scope.form_title = "Delete User";
            $scope._id = id;
            $scope._index = key;
            $('#myModalDelete').modal('show');
        };

        //delete record
        $scope.confirmDelete = function (id, key) {
            $http({
                method: 'DELETE',
                url: API_URL + 'user/delete/' + id
            }).then(function (response) {
                if (response.data.code === SUCCESS_CODE) {
                    $scope.users.splice(key, 1);
                    alert(response.data.message);
                    $('#myModalDelete').modal('hide');
                } else {
                    alert(response.data.message);
                }
            }, function (response) {
                alert(response.data.message);
            });
        }
    })
;