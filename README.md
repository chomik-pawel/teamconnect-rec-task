Jak uruchomić:
1) w konsoli wpisujemy make start
2) jak kontener się odpali to robimy make tests
3) testy na zielono :)


Zadanie:

Proszę napisać próbkę kodu zgodną z poniższymi wymaganiami biznesowymi oraz  

• PHP w wersji 8.*

• Framework agnostic

• DomainDrivenDesign (zwracamy uwagę na strukturę kodu oraz powiązania między jego poszczególnymi elmentami)

• Całość przetestowana testami jednostkowymi (przypadki testowe powinny pokrywać wszystkie scenariusze)



“Konto bankowe i płatność”:

Konto bankowe:

• konto ma swoją walutę

• na konto można przyjmować pieniądzie (credit) oraz wysyłać z niego pieniądze (debit) tylko w takiej samej walucie jaką ma konto

• Konto ma swój balans wynikający z wykonanych na nim operacji credit i debit

• Każda płatność wychodząca (debit) musi być powiększona o koszty transakcji 0,5%

• z konta bankowego można wysłać pieniądze tylko jeżeli kwota płatności (powiększona o koszt transakcji) mieści się w dostępnym balansie

• Konto bankowe zezwala na zrobienie maksymalnie 3 płatności wychodzących 1 dnia

Płatność:

• Zawiera kwotę oraz walutę 
