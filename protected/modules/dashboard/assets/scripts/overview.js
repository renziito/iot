class Overview {
  constructor() {
    this.config = $.extend(true, APP, {});
  }

  init() {
    
  }

}

$(() => {
  (new Overview()).init()
})