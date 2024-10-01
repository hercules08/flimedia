console.log("Editor Scripts");

document.addEventListener("DOMContentLoaded", function () {
  let observer = new MutationObserver(function (mutations) {
    mutations.forEach(function (mutation) {
      if (mutation.addedNodes) {
        mutation.addedNodes.forEach(function (node) {
          if (
            node.nodeType === 1 &&
            node.matches(".wp-block-acf-img-gallery") // check to see if wp-block-acf-img-gallery exists
          ) {
            // Check if the added node is an element and has the desired class
            node.classList.add("example-class-addition");
          }
        });
      }
    });
  });

  // Configuration of the observer:
  let config = { childList: true, subtree: true };

  // Start observing the body for added nodes
  observer.observe(document.body, config);
});
