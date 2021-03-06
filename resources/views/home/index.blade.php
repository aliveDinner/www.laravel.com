<!DOCTYPE html>
<html lang="en-US" ng-app="Site">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://www.laravel.com/views/css/layout.css" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif !important;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .font-raleway {
            font-family: 'Raleway', sans-serif;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>

    <!-- Load Bootstrap CSS -->
    <!--<link href="https://www.laravel.com/views/components/bootstrap-3.3.7/css/bootstrap.css" rel="stylesheet">-->
    <link href="https://www.laravel.com/views/css/app.css" rel="stylesheet">
</head>
<body>
<div class="flex-center position-ref full-height" ng-controller="SiteController">

    <!-- Table-to-load-the-data Part -->
    <table class="table" title="{{theTime}}" ng-click="closeTime()">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact No</th>
            <th>Position</th>
            <th>
                <button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New Employee
                </button>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="(key, user)  in users">
            <td>{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.phone }}</td>
            <td>{{ user.position }}</td>
            <td>
                <button class="btn btn-default btn-xs btn-detail" ng-click="toggle('update', key)">Edit</button>
                <button class="btn btn-danger btn-xs btn-delete" ng-click="showDelete(user.id, key)">Delete</button>
            </td>
        </tr>
        </tbody>
    </table>
    <!-- End of Table-to-load-the-data Part -->
    <!-- Modal (Pop up when detail button clicked) -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">{{form_title}}</h4>
                </div>
                <div class="modal-body">
                    <form name="frmEmployees" class="form-horizontal" novalidate="">

                        <div class="form-group error">
                            <label for="name" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control has-error" id="name" name="name"
                                       placeholder="Fullname" value="{{name}}"
                                       ng-model="user.name" ng-required="true">
                                <span class="help-inline"
                                      ng-show="frmEmployees.name.$invalid && frmEmployees.name.$touched">Name field is required</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">Contact Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="Contact Number" value="{{phone}}"
                                       ng-model="user.phone" ng-required="true">
                                <span class="help-inline"
                                      ng-show="frmEmployees.phone.$invalid && frmEmployees.phone.$touched">Contact number field is required</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="position" class="col-sm-3 control-label">Position</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="position" name="position"
                                       placeholder="Position" value="{{position}}"
                                       ng-model="user.position" ng-required="true">
                                <span class="help-inline"
                                      ng-show="frmEmployees.position.$invalid && frmEmployees.position.$touched">Position field is required</span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id,_index)"
                            ng-disabled="frmEmployees.$invalid">Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal (Pop up when detail button clicked) -->
    <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalDeleteLabel">{{form_title}}</h4>
                </div>
                <div class="modal-body">
                    <h3 >Are you sure you want this record?</h3>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(_id, _index)">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
<script src="https://www.laravel.com/views/components/angular/angular.min.js"></script>
<script src="https://www.laravel.com/views/components/jquery-3.3.1/jquery.min.js"></script>
<script src="https://www.laravel.com/views/components/bootstrap-3.3.7/js/bootstrap.min.js"></script>

<!-- AngularJS Application Scripts -->
<script src="https://www.laravel.com/views/js/helper.js"></script>
<script src="https://www.laravel.com/views/script/app.js"></script>
<script src="https://www.laravel.com/views/script/services/helper.js"></script>
<script src="https://www.laravel.com/views/script/layout.js"></script>
</body>
</html>
