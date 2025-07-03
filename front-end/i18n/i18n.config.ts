import { dateTimeFormats } from "~/i18n/dateTimeFormat";

export default defineI18nConfig(() => ({
    locale: 'en',
    fallbackLocale: 'en',
    legacy: false,
    globalInjection: true,
    dateTimeFormats,
}));
