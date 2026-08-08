export default class JinsTabs {
  constructor(parentSelector = '.jins-tabs') {
    this.tabGroups = [];
    const tabContainers = document.querySelectorAll(parentSelector);
    
    if (!tabContainers.length) return;
    
    // Process each tab container separately
    tabContainers.forEach(container => {
      const navMenu = container.querySelector('.jins-tabs__nav-menu');
      const navItems = Array.from(container.querySelectorAll('.jins-tabs__nav-item'));
      const panelElements = Array.from(container.querySelectorAll('.jins-tabs__panel'));
      
      if (!navItems.length || !panelElements.length) return;
      
      // Create panel map for this specific group
      const panels = panelElements.reduce((acc, panel) => {
        acc[panel.id] = panel;
        return acc;
      }, {});
      
      // Store the group
      this.tabGroups.push({ container, navItems, panels });

      // Add event listeners for this group
      container.addEventListener('jins_tabs:switch_tab', event => {
        const { clickedNavItem } = event.detail;
        this.handleSwitchTab( clickedNavItem, navItems, panels );
      });
      
      navMenu.addEventListener('click', event => {
        const target = event.target;
        const navItem = target.closest( '.jins-tabs__nav-item' );
        if( ! navItem ) {
          return;
        }
        const switchTabEvent = new CustomEvent('jins_tabs:switch_tab', {
          detail: {
            clickedNavItem: navItem
          },
        });
        container.dispatchEvent(switchTabEvent);
      });
    });
  }
  
  handleSwitchTab(self, navItems, panels) {
    if(self.getAttribute('aria-selected') === 'true') {
      return;
    }


    
    const currentSelectedTab = navItems.find(item => item.getAttribute('aria-selected') === 'true');
    const currentSelectedPanel = panels[currentSelectedTab.getAttribute('aria-controls')];
    const newSelectedPanel = panels[self.getAttribute('aria-controls')];

    this.updateTabState(currentSelectedTab, self, currentSelectedPanel, newSelectedPanel);
  }

  updateTabState( oldTab, newTab, oldPanel, newPanel ) {
    // Update the state of the old tab
    oldTab.setAttribute('aria-selected', 'false');
    oldTab.setAttribute('tabindex', '-1');
    oldPanel.setAttribute('aria-hidden', 'true');

    // Update the state of the new tab
    newTab.setAttribute('aria-selected', 'true');
    newTab.setAttribute('tabindex', '0');
    newPanel.setAttribute('aria-hidden', 'false');
  }
}