class Tabs {
    constructor(tabSelector, contentSelector) {
      this.tabs = Array.from(document.querySelectorAll(tabSelector));
      this.tabContents = Array.from(document.querySelectorAll(contentSelector));
    }

    hideAllTabContents() {
      this.tabContents.forEach(content => {
        content.style.display = 'none';
      });
    }

    activateTab(tab) {
      const target = tab.getAttribute('data-tab-target');
      const target1 = tab.getAttribute('data-tab-target1');
      const tabContent = document.getElementById(target);
      const tabContent1 = document.getElementById(target1);

      if (tabContent) {
        this.hideAllTabContents();
        this.tabs.forEach(tab => {
          tab.classList.remove('active');
        });

        tab.classList.add('active');
        tabContent.style.display = 'block';
      }

      if (tabContent1) {
        // this.hideAllTabContents();
        this.tabs.forEach(tab => {
          tab.classList.remove('active');
        });

        tab.classList.add('active');
        tabContent1.style.display = 'block';
      }
    }

    initializeTabs() {
      const defaultTab = this.tabs[0];
      this.activateTab(defaultTab);

      this.tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          const activeTab = document.querySelector('.tab.active');
          if (activeTab) {
            activeTab.classList.remove('active');
          }
          this.activateTab(tab);
        });
      });
    }
  }

  const tabsInstance = new Tabs('.my-tab', '.my-tab-content');
  tabsInstance.initializeTabs();

  const tabsInstance1 = new Tabs('.my-tab1', '.my-tab-content1');
  tabsInstance1.initializeTabs();
