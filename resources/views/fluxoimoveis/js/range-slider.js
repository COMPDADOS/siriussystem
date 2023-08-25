/*----------------------------------
	//------ RANGE SLIDER ------//
	-----------------------------------*/
$(".slider-range").slider({
	range: true,
	min: 500,
	max: 20000000,
	step: 200,
	values: [700, 5000],
	slide: function (event, ui) {
		$(".slider_amount").val("R$" + ui.values[0].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") + " - $" + ui.values[1].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1."));
	}
});
$(".slider_amount").val("Faixa de Preço: R$" + $(".slider-range").slider("values", 0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "R$1.") + " - R$" + $(".slider-range").slider("values", 1).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "R$1."));
