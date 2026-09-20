import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';

import HeroSearchWidget from './components/HeroSearchWidget.vue';
import TourFilterWidget from './components/TourFilterWidget.vue';
import VisaRequirementFilter from './components/VisaRequirementFilter.vue';
import VisaApplicationWizard from './components/VisaApplicationWizard.vue';

const pinia = createPinia();

/**
 * Helper to conditionally mount Vue 3 components on dedicated container elements
 */
const mountIsland = (selector, Component, props = {}) => {
    const el = document.querySelector(selector);
    if (el) {
        const app = createApp(Component, {
            ...props,
            ...el.dataset
        });
        app.use(pinia);
        app.mount(el);
    }
};

document.addEventListener('DOMContentLoaded', () => {
    mountIsland('#vue-hero-search', HeroSearchWidget);
    mountIsland('#vue-tour-filter', TourFilterWidget);
    mountIsland('#vue-visa-requirements', VisaRequirementFilter);
    mountIsland('#vue-visa-wizard', VisaApplicationWizard);
});
