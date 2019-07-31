(function ($) {
  'use strict';

  var ProjectUsers = function () {
    this.config = $.extend(true, APP, {});
    this.id = Request._GET.id;
    this.tableAssignedUsersAdmin = new TablePlugin("table#tbProjectAssignedUsersAdmin");
    this.tableAssignedUsersAdmin = new TablePlugin("table#tbProjectAssignedUsersAdmin");
    this.tableUsersAdmin = false;
    this.tableUsersVisor = false;
    this.tableAssignedUsersVisor = new TablePlugin("table#tbProjectAssignedUsersVisor");
    this.$btnAddUserAdmin = $("#btnAddUserAdmin");
    this.$btnAddUserVisor = $("#btnAddUserVisor");
    this.$modalAddUserAdmin = $("#md-add-user-admin");
    this.$modalAddUserVisor = $("#md-add-user-visor");
    this.url = {
      listUsersAdmin: this.config.url.controllerFullUrl + '/listUsersAdmin/id/' + this.id,
      listAssignedUsersAdmin: this.config.url.controllerFullUrl + '/listAssignedUsersAdmin/id/' + this.id,
      listUsersVisor: this.config.url.controllerFullUrl + '/listUsersVisor/id/' + this.id,
      listAssignedUsersVisor: this.config.url.controllerFullUrl + '/listAssignedUsersVisor/id/' + this.id,
      assignedUsersAdmin: this.config.url.controllerFullUrl + '/assignedUsersAdmin',
      assignedUsersVisor: this.config.url.controllerFullUrl + '/assignedUsersVisor',
      unassignedUser: this.config.url.controllerFullUrl + '/unassignedUser',
    };
  };

  ProjectUsers.prototype._openModal = function (modal) {
    modal.modal("show");
  };

  ProjectUsers.prototype._closeModal = function (modal) {
    modal.modal("hide");
  };

  ProjectUsers.prototype._addUser = function (url, user_id) {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.post(url, {
        adduser: {
          project_id: _class.id,
          user_id: user_id
        }
      }, function (response) {
        if (!response.error) {
          Notify("success", response.message);
          resolve(response.data);
        }
      }).fail(function (error) {
        Notify("error", "La operación no pudo completarse correctamente");
        reject(error);
      });
    });
  };

  ProjectUsers.prototype._removeUser = function (projectuser_id) {
    var _class = this;

    return new Promise(function (resolve, reject) {
      $.post(_class.url.unassignedUser, {
        removeuser: {
          id: projectuser_id
        }
      }, function (response) {
        if (!response.error) {
          Notify("success", response.message);
          resolve(response.data);
        }
      }).fail(function (error) {
        Notify("error", "La operación no pudo completarse correctamente");
        reject(error);
      });
    });
  };

  ProjectUsers.prototype._initModalAddUserAdmin = function () {
    var _class = this;

    this.$btnAddUserAdmin.on('click', function (e) {
      _class._openModal(_class.$modalAddUserAdmin);
    });

    this.$modalAddUserAdmin.on("show.bs.modal", function () {
      _class._initTableUsersAdmin();
    });

    this.$modalAddUserAdmin.on("hidden.bs.modal", function () {
      _class.tableUsersAdmin.destroy();
      _class.tableUsersAdmin = false;
    });

  };
  
  ProjectUsers.prototype._initModalAddUserVisor = function () {
    var _class = this;

    this.$btnAddUserVisor.on('click', function (e) {
      _class._openModal(_class.$modalAddUserVisor);
    });

    this.$modalAddUserVisor.on("show.bs.modal", function () {
      _class._initTableUsersVisor();
    });

    this.$modalAddUserVisor.on("hidden.bs.modal", function () {
      _class.tableUsersVisor.destroy();
      _class.tableUsersVisor = false;
    });

  };

  ProjectUsers.prototype._initTableUsersAdmin = function () {
    var _class = this;

    this.tableUsersAdmin = new TablePlugin("table#tbProjectUsersAdmin");
    this.tableUsersAdmin.setOptions({
      url: this.url.listUsersAdmin
    });
    this.tableUsersAdmin.columns([
      {field: 'id', title: 'ID',width:'10px'},
      {
        field: 'img',
        title: "Avatar",
        width:'20px',
        formatter: function (value, row, index) {
          var view = [
            '<div class="text-center">',
            '<img class="rounded-circle" src="' + _class.config.url.baseFullUrl + '/' + value + '" width="38" height="38">',
            '</div>'
          ];
          return view.join('');
        },
      },
      {field: 'name', title: 'Nombres'},
      {field: 'email', title: 'Correo'},
      {
        label: 'action',
        title: '...',
        formatter: function (value, row, index, field) {
          var view = [
            '<button class="btn btn-success btn-sm add-user">',
            '<i class="fa fa-plus"></i>',
            '</button>'
          ];

          return view.join("");
        },
        events: {
          'click .add-user': function (e, value, row, index) {
            _class._addUser(_class.url.assignedUsersAdmin, row.id)
              .then(function (data) {
                _class.tableAssignedUsersAdmin.refresh();
                _class.tableUsersAdmin.refresh();
              })
              .catch(function (error) {

              });
          }
        }
      }
    ]);
    this.tableUsersAdmin.init();
  };
  
  ProjectUsers.prototype._initTableUsersVisor = function () {
    var _class = this;

    this.tableUsersVisor = new TablePlugin("table#tbProjectUsersVisor");
    this.tableUsersVisor.setOptions({
      url: this.url.listUsersVisor
    });
    this.tableUsersVisor.columns([
      {field: 'id', title: 'ID',width:'10px'},
      {
        field: 'img',
        title: "Avatar",
        width:'20px',
        formatter: function (value, row, index) {
          var view = [
            '<div class="text-center">',
            '<img class="rounded-circle" src="' + _class.config.url.baseFullUrl + '/' + value + '" width="38" height="38">',
            '</div>'
          ];
          return view.join('');
        },
      },
      {field: 'name', title: 'Nombres'},
      {field: 'email', title: 'Correo'},
      {
        label: 'action',
        title: '...',
        formatter: function (value, row, index, field) {
          var view = [
            '<button class="btn btn-success btn-sm add-user">',
            '<i class="fa fa-plus"></i>',
            '</button>'
          ];

          return view.join("");
        },
        events: {
          'click .add-user': function (e, value, row, index) {
            _class._addUser(_class.url.assignedUsersVisor, row.id)
              .then(function (data) {
                _class.tableAssignedUsersVisor.refresh();
                _class.tableUsersVisor.refresh();
              })
              .catch(function (error) {

              });
          }
        }
      }
    ]);
    this.tableUsersVisor.init();
  };

  ProjectUsers.prototype._initTableAssigneUsersAdmin = function () {
    var _class = this;

    this.tableAssignedUsersAdmin.setOptions({
      url: this.url.listAssignedUsersAdmin
    });
    this.tableAssignedUsersAdmin.columns([
      {field: 'id', title: 'ID', width:'10px'},
      {
        field: 'img',
        title: "Avatar",
        width:'50px',
        formatter: function (value, row, index) {
          var view = [
            '<div class="text-center">',
            '<img class="rounded-circle" src="' + _class.config.url.baseFullUrl + '/' + value + '" width="38" height="38">',
            '</div>'
          ];
          return view.join('');
        },
      },
      {field: 'name', title: 'Nombres'},
      {field: 'email', title: 'Correo'},
      {
        label: 'action',
        title: '...',
        formatter: function (value, row, index, field) {
          var view = [
            '<button class="btn btn-danger btn-sm remove-user">',
            '<i class="fa fa-trash"></i>',
            '</button>'
          ];

          return view.join("");
        },
        events: {
          'click .remove-user': function (e, value, row, index) {
            _class._removeUser(row.id)
              .then(function (data) {
                _class.tableAssignedUsersAdmin.refresh();
              })
              .catch(function (error) {

              });
          }
        }
      }
    ]);
    this.tableAssignedUsersAdmin.init();
  };

  ProjectUsers.prototype._initTableAssigneUsersVisor = function () {
    var _class = this;

    this.tableAssignedUsersVisor.setOptions({
      url: this.url.listAssignedUsersVisor
    });
    this.tableAssignedUsersVisor.columns([
      {field: 'id', title: 'ID', width:'10px'},
      {
        field: 'img',
        title: "Avatar",
        width:'50px',
        formatter: function (value, row, index) {
          var view = [
            '<div class="text-center">',
            '<img class="rounded-circle" src="' + _class.config.url.baseFullUrl + '/' + value + '" width="38" height="38">',
            '</div>'
          ];
          return view.join('');
        },
      },
      {field: 'name', title: 'Nombres'},
      {field: 'email', title: 'Correo'},
      {
        label: 'action',
        title: '...',
        formatter: function (value, row, index, field) {
          var view = [
            '<button class="btn btn-danger btn-sm remove-user">',
            '<i class="fa fa-trash"></i>',
            '</button>'
          ];

          return view.join("");
        },
        events: {
          'click .remove-user': function (e, value, row, index) {
            _class._removeUser(row.id)
              .then(function (data) {
                _class.tableAssignedUsersVisor.refresh();
              })
              .catch(function (error) {

              });
          }
        }
      }
    ]);
    this.tableAssignedUsersVisor.init();
  };

  ProjectUsers.prototype.init = function () {
    this._initModalAddUserAdmin();
    this._initModalAddUserVisor();
    this._initTableAssigneUsersAdmin();
    this._initTableAssigneUsersVisor();
  };

  (new ProjectUsers()).init();

})(window.jQuery);

