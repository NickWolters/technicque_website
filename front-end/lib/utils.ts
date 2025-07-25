import { type ClassValue, clsx } from 'clsx'
import { twMerge } from 'tailwind-merge'
import type {LocaleContent} from "~/lib/locale";

export function cn(...inputs: ClassValue[]) {
  return twMerge(clsx(inputs))
}

export function getLocaleSpecificVariable(localeContent : LocaleContent) : any {
  const { locale } = useI18n();
  return new Map(Object.entries(localeContent)).get(locale.value);
}