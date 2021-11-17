var app = new Vue({
  el: "#app",
  data: {
    title: "",
    description: "",
    title_url: "",
    message: ""
  },
  methods: {
    reset() {
      this.title = "";
      this.description = "";
      this.title_url = "";
      this.message = "";
      this.$refs.form.reset();
    },
    setValues() {
      this.title = "Wirtualne Pomorze";
      this.description =
        "Wirtualne Pomorze budują właśnie takie osoby jak Ty. Nie ważne czy jesteś dziewczyną czy chłopakiem. Dołącz do Nas. Wszyscy tutaj zobowiązują się do tego, aby Wirtualne Pomorze reprezentował świat, w którym chcemy żyć i grać.";
      this.title_url = "https://wirtualne-pomorze.pl/index.php?a=zloz-wniosek";
      this.message =
        "To jest przykładowa wiadomość! Podoba Ci się? Zostaw kciuka w górę.";
	  this.$refs.form.setValues();
    }
  }
});