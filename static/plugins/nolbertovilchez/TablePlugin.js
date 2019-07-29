
  var TablePlugin = function(table) {
    this.$options = $.extend(true, {}, APP.default.bootstrapTable)
    this.$table = $(table)
  }

  TablePlugin.prototype.init = function(){
    this.$table.bootstrapTable(this.getOptions())
  }

  TablePlugin.prototype.setOptions = function(options) {
    this.$options = $.extend(true, this.$options, options)
  }

  TablePlugin.prototype.getOptions = function(){
    return this.$options;
  }

  TablePlugin.prototype.getData = function(){
    return this.$table.bootstrapTable('getData');
  }

  TablePlugin.prototype.refresh = function(){
    this.$table.bootstrapTable('refresh');
  }

  TablePlugin.prototype.destroy = function(){
    this.$table.bootstrapTable("destroy");
  }

  TablePlugin.prototype.events = function(eventsObj){
    var eventsObj = eventsObj || {};
    this.$options = Object.assign({}, this.$options, eventsObj);
  }

  TablePlugin.prototype.getRowByAttributes = function(params){
    var params = params || {};
    var data = this.$table.bootstrapTable("getData");
  }

  TablePlugin.prototype.columns = function(columns) {
    var columns = columns || [];
    if (columns.length > 0)
      this.$options.columns = columns;
  }


