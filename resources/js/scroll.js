// スクロールトップボタン
new Vue(
  {
    el: '#btn',
    data: {
      scrollTimer:0,
      scrollY: 0,
      scroll: false,
    },
    mounted(){
      window.addEventListener('scroll',this.handleScroll);
    },
    methods: {

      handleScroll:function(){
        if(this.scrollTimer){
          return;
        }
        // this.scrollTimer = setTimeout(()=>{
        //   this.scrollY = window.scrollY;
        //   clearTimeout(this.scrollTimer);
        //   this.scrollTimer = 0;
        // },100);
        this.scrollTimer = setTimeout(()=>{
          this.scroll = window.scrollY > 800 ? true : '';
          clearTimeout(this.scrollTimer);
          this.scrollTimer = 0;
        },100);
      },

      scrollTop: function(){
        window.scrollTo({
          top: 0,
          behavior: "smooth"
        });
      }
    }
  }
)