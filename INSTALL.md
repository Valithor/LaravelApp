# Nextclick

Nextclick w oparciu o **nuxt.js**

## Instalacja

``` bash
$ composer install  
$ php artisan migrate
$ php artisan passport:install
$ php artisan db:seed
$ cd frontend
$ npm install

# odpalanie nuxt, odpali localhost: 3000
$ npm run dev
# budowanie n aprodukcję  
$ npm run build
```
Dane konfiguracyjne:  
**Laravel:** .env  
**Nuxt:** frontend/.env  

## Ważne, koniecznie trzeba się zapoznać z:
http://nuxtjs.org/  
http://auth.nuxtjs.org/  
http://axios.nuxtjs.org/  
https://pwa.nuxtjs.org/  

## Uwagi drobne
Dane dzielone między komponentami trzymamy w **Vuex** (np. menu, alerty): https://vuex.vuejs.org/, https://nuxtjs.org/guide/vuex-store/  
Dane w obrębie komponentu po prostu w:
```
data () {
    return {}
}
```
1. Wart korzystać z **middlwarów** tak jak w laravelu jeżeli chcemy się "wbić" przed router.  
2. Wszelkie dodatkowe pluginy dorzucamy na wzór obecnych (bootsrap, jquery, itd.) w **plugins/**.  
3. Jak potrzeba użycia jquery (np. dla jakiegoś pluginu) to najlepiej dorzucać skrypty do **plugins/frontend.js**.
4. Jeżeli coś używamy w wielu miejscach, np. alerty, galerie, itd. - najlepiej wydzelić to do komponentu (na wzór Alrt.vue): **componsents/**.
5. Dodałem więcej komentarzy w **pages/panel/users/index.vue** i **pages/panel/users/_id.vue**.  
6. Użytkowników testowych można sobei zdefiniować w **Database/UserSeed.php**.  
7. Zostawiłem domyślny config dla **ESLint** (dodałem tylko regułę dla **console.log**) oraz **prettiera** więc proponuje się trzymać dla porządku.
8. Do uprawnień wrzuciłem Laravel bouncer.
9. W **plugins/components.vue** ładujemy globalne komponenty które mają być dostępne wszędzie.
10. **Po zalogowaniu przerzuci do strony ze zrzutem obiektu auth.user z Vuex, tak dla podglądu. Dorzuciłem do niego Laravelu Abilities i najlepiej na bazie tego sterować co wyświetlić użytkowników (np. menu). Tu właśnie chyba najlepszy będzie jakiś prosty middlware. Oczywiście i tak uprawnienia trzeba sprawdzać po stronie Laravela;)**

W razie pytań chętnie pomogę na skype: andrzej.walec lub mailowo andrzej@redicon.pl:)
