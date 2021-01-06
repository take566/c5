jQuery(document).ready(function ($) {
  var filteringButtons = $(".filteringButtons a"),
      filteringWrapper = $(".filteringContents"),
      filteringContents = filteringWrapper.find(".filteringContent");

  filteringButtons.on("click", function () {
    var clickedButton = $(this),
        clickedCategory = clickedButton.attr("data-category");

    filteringWrapper.stop().fadeTo(500, 0, function () {
      if(clickedCategory == "all") {
        filteringContents.show();
      } else {
        filteringContents.hide();
        for(var i = 0, j = filteringContents.length; i < j; i++) {
          var nowContent = filteringContents.eq(i);

          if(nowContent.attr("data-category") == clickedCategory) nowContent.show();
        }
      }
      filteringWrapper.stop().fadeTo(750, 1);
    });

    return false;
  });
});
