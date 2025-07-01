## Allergie
| Kolomnaam           | Datatype   | Length | Opmerking                      |
|---------------------|------------|--------|--------------------------------|
| Id                  | INT        |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Naam                | VARCHAR    | 50     | NOT Nullable                  |
| Omschrijving        | VARCHAR    | 255    | NOT Nullable                  |
| AnafylactischRisico | VARCHAR    | 20     | NOT Nullable                  |
| IsActive            | BOOL       |        | NOT Nullable                  |
| Opmerking           | VARCHAR    | 255    | Nullable                      |
| DatumAangemaakt     | TIMESTAMP  | 6      | NOT Nullable                  |
| DatumGewijzigd      | TIMESTAMP  | 6      | NOT Nullable                  |

## AllergiePerPersoon
| Kolomnaam  | Datatype | Length | Opmerking                    |
| ---------- | -------- | ------ | ---------------------------- |
| Id         | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| PersoonId  | INT      |        | FK , Unsigned, NOT Nullable  |
| AllergieId | INT      |        | FK , Unsigned, NOT Nullable  |
| IsActive   | BOOL     |        | NOT Nullable                 |
| Opmerking  | VARCHAR  | 255    | Nullable                     |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable                |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable                |

## Rol
| Kolomnaam | Datatype | Length | Opmerking                  |
|-----------|----------|--------|----------------------------|
| Id        | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Naam      | VARCHAR  | 50     | NOT Nullable               |
| IsActive  | BOOL     |        | NOT Nullable               |
| Opmerking | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## RolPerGebruiker
| Kolomnaam    | Datatype | Length | Opmerking                  |
|--------------|----------|--------|----------------------------|
| Id           | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| GebruikerId  | INT      |        | FK  , Unsigned, NOT Nullable |
| RolId        | INT      |        | FK  , Unsigned, NOT Nullable |
| IsActive     | BOOL     |        | NOT Nullable               |
| Opmerking    | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## Categorie
| Kolomnaam    | Datatype | Length | Opmerking                  |
|--------------|----------|--------|----------------------------|
| Id           | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Naam         | VARCHAR  | 10     | NOT Nullable               |
| Omschrijving | VARCHAR  | 255    | NOT Nullable               |
| IsActive     | BOOL     |        | NOT Nullable               |
| Opmerking    | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## EetwensPerGezin
| Kolomnaam | Datatype | Length | Opmerking                  |
|-----------|----------|--------|----------------------------|
| Id        | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| GezinId   | INT      |        | FK  , Unsigned, NOT Nullable |
| EetwensId | INT      |        | FK , Unsigned, NOT Nullable |
| IsActive  | BOOL     |        | NOT Nullable               |
| Opmerking | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## Contact
| Kolomnaam    | Datatype | Length | Opmerking                  |
|--------------|----------|--------|----------------------------|
| Id           | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Straat       | VARCHAR  | 255    | NOT Nullable               |
| Huisnummer   | INT      | 11     | NOT Nullable               |
| Toevoeging   | VARCHAR  | 10     | Nullable                   |
| Postcode     | VARCHAR  | 10     | NOT Nullable               |
| Woonplaats   | VARCHAR  | 50     | NOT Nullable               |
| Email        | VARCHAR  | 255    | NOT Nullable               |
| Mobiel       | VARCHAR  | 20     | NOT Nullable               |
| IsActive     | BOOL     |        | NOT Nullable               |
| Opmerking    | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## ContactPerLeverancier
| Kolomnaam    | Datatype | Length | Opmerking                  |
|--------------|----------|--------|----------------------------|
| Id           | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| LeverancierId| INT      |        | FK , Unsigned, NOT Nullable |
| ContactId    | INT      |        | FK , Unsigned, NOT Nullable |
| IsActive     | BOOL     |        | NOT Nullable               |
| Opmerking    | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## ContactPerGezin
| Kolomnaam | Datatype | Length | Opmerking                  |
|-----------|----------|--------|----------------------------|
| Id        | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| GezinId   | INT      |        | FK, Unsigned, NOT Nullable |
| ContactId | INT      |        | FK , Unsigned, NOT Nullable |
| IsActive  | BOOL     |        | NOT Nullable               |
| Opmerking | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## Eetwens
| Kolomnaam    | Datatype | Length | Opmerking                  |
|--------------|----------|--------|----------------------------|
| Id           | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Naam         | VARCHAR  | 50     | NOT Nullable               |
| Omschrijving | VARCHAR  | 255    | NOT Nullable               |
| IsActive     | BOOL     |        | NOT Nullable               |
| Opmerking    | VARCHAR  | 255    | Nullable                   |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable              |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable              |

## Gebruiker
| Kolomnaam    | Datatype | Length | Opmerking                      |
|--------------|----------|--------|--------------------------------|
| Id           | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| PersoonId    | INT      |        | FK , Unsigned, NOT Nullable   |
| InlogNaam    | VARCHAR  | 50     | NOT Nullable                  |
| Gebruikersnaam| VARCHAR | 50     | NOT Nullable                  |
| Wachtwoord   | VARCHAR  | 255    | NOT Nullable                  |
| IsIngelogd   | TINYINT  | 1      | NOT Nullable                  |
| Ingelogd     | TIMESTAMP |        | Nullable                      |
| Uitgelogd    | TIMESTAMP |        | Nullable                      |
| IsActive     | BOOL     |        | NOT Nullable                  |
| Opmerking    | VARCHAR  | 255    | Nullable                      |
| DatumAangemaakt | TIMESTAMP | 6 | NOT Nullable                  |
| DatumGewijzigd  | TIMESTAMP | 6 | NOT Nullable                  |

## Gezin
| Kolomnaam           | Datatype | Length | Opmerking                      |
|---------------------|----------|--------|--------------------------------|
| Id                  | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Naam                | VARCHAR  | 50     | NOT Nullable                   |
| Code                | VARCHAR  | 10     | NOT Nullable                   |
| Omschrijving        | VARCHAR  | 255    | NOT Nullable                   |
| AantalVolwassenen   | INT      | 2      | NOT Nullable                   |
| AantalKinderen      | INT      | 2      | NOT Nullable                   |
| AantalBabys         | INT      | 2      | NOT Nullable                   |
| TotaalAantalPersonen| INT      | 2      | NOT Nullable                   |
| IsActive            | BOOL     |        | NOT Nullable                   |
| Opmerking           | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt     | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd      | TIMESTAMP | 6      | NOT Nullable                   |

## Leverancier
| Kolomnaam         | Datatype | Length | Opmerking                      |
|-------------------|----------|--------|--------------------------------|
| Id                | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Naam              | VARCHAR  | 50     | NOT Nullable                   |
| ContactPersoon    | VARCHAR  | 50     | NOT Nullable                   |
| LeverancierNummer | VARCHAR  | 10     | NOT Nullable                   |
| LeverancierType   | VARCHAR  | 20     | NOT Nullable                   |
| IsActive          | BOOL     |        | NOT Nullable                   |
| Opmerking         | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt   | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd    | TIMESTAMP | 6      | NOT Nullable                   |

## Persoon
| Kolomnaam        | Datatype | Length | Opmerking                      |
|------------------|----------|--------|--------------------------------|
| Id               | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| GezinId          | INT      |        | FK, Unsigned, Nullable         |
| Voornaam         | VARCHAR  | 50     | NOT Nullable                   |
| Tussenvoegsel    | VARCHAR  | 20     | Nullable                       |
| Achternaam       | VARCHAR  | 50     | NOT Nullable                   |
| Geboortedatum    | TIMESTAMP |        | NOT Nullable                   |
| TypePersoon      | VARCHAR  | 20     | NOT Nullable                   |
| IsVertegenwoordiger| TINYINT| 1      | NOT Nullable                   |
| IsActive         | BOOL     |        | NOT Nullable                   |
| Opmerking        | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt  | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd   | TIMESTAMP | 6      | NOT Nullable                   |

## Magazijn
| Kolomnaam         | Datatype | Length | Opmerking                      |
|-------------------|----------|--------|--------------------------------|
| Id                | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| Ontvangstdatum    | TIMESTAMP |        | NOT Nullable                   |
| Uitleveringsdatum | TIMESTAMP |        | Nullable                       |
| VerpakkingsEenheid| VARCHAR  | 20     | NOT Nullable                   |
| Aantal            | INT      | 11     | NOT Nullable                   |
| IsActive          | BOOL     |        | NOT Nullable                   |
| Opmerking         | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt   | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd    | TIMESTAMP | 6      | NOT Nullable                   |

## Product
| Kolomnaam         | Datatype | Length | Opmerking                      |
|-------------------|----------|--------|--------------------------------|
| Id                | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| CategorieId       | INT      |        | FK , Unsigned, NOT Nullable    |
| Naam              | VARCHAR  | 50     | NOT Nullable                   |
| SoortAllergie     | VARCHAR  | 50     | FK , Unsigned ,Nullable        |
| Barcode           | VARCHAR  | 20     | NOT Nullable                   |
| Houdbaarheidsdatum| TIMESTAMP |        | NOT Nullable                   |
| Omschrijving      | VARCHAR  | 255    | NOT Nullable                   |
| Status            | VARCHAR  | 30     | NOT Nullable                   |
| IsActive          | BOOL     |        | NOT Nullable                   |
| Opmerking         | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt   | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd    | TIMESTAMP | 6      | NOT Nullable                   |

## ProductPerVoedselpakket
| Kolomnaam           | Datatype | Length | Opmerking                      |
|---------------------|----------|--------|--------------------------------|
| Id                  | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| VoedselpakketId     | INT      |        | FK, Unsigned, NOT Nullable     |
| ProductId           | INT      |        | FK , Unsigned, NOT Nullable    |
| AantalProductEenheden| INT     | 11     | NOT Nullable                   |
| IsActive            | BOOL     |        | NOT Nullable                   |
| Opmerking           | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt     | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd      | TIMESTAMP | 6      | NOT Nullable                   |

## ProductPerLeverancier
| Kolomnaam              | Datatype | Length | Opmerking                      |
|------------------------|----------|--------|--------------------------------|
| Id                     | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| LeverancierId          | INT      |        | FK , Unsigned, NOT Nullable    |
| ProductId              | INT      |        | FK , Unsigned, NOT Nullable    |
| DatumAangeleverd       | TIMESTAMP |        | NOT Nullable                   |
| DatumEerstVolgendeLevering | TIMESTAMP |        | Nullable                       |
| IsActive               | BOOL     |        | NOT Nullable                   |
| Opmerking              | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt        | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd         | TIMESTAMP | 6      | NOT Nullable                   |

## ProductPerMagazijn
| Kolomnaam   | Datatype | Length | Opmerking                      |
|-------------|----------|--------|--------------------------------|
| Id          | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| ProductId   | INT      |        | FK, Unsigned, NOT Nullable     |
| MagazijnId  | INT      |        | FK , Unsigned, NOT Nullable    |
| Locatie     | VARCHAR  | 50     | NOT Nullable                   |
| IsActive    | BOOL     |        | NOT Nullable                   |
| Opmerking   | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt | TIMESTAMP | 6   | NOT Nullable                  |
| DatumGewijzigd  | TIMESTAMP | 6   | NOT Nullable                  |

## Voedselpakket
| Kolomnaam         | Datatype | Length | Opmerking                      |
|-------------------|----------|--------|--------------------------------|
| Id                | INT      |        | PK, auto_increment, unsigned, NOT Nullable, UNIQUE |
| GezinId           | INT      |        | FK, Unsigned, NOT Nullable     |
| PakketNummer      | INT      | 11     | NOT Nullable                   |
| DatumSamenstelling| TIMESTAMP |        | NOT Nullable                   |
| DatumUitgifte     | TIMESTAMP |        | Nullable                       |
| Status            | VARCHAR  | 30     | NOT Nullable                   |
| IsActive          | BOOL     |        | NOT Nullable                   |
| Opmerking         | VARCHAR  | 255    | Nullable                       |
| DatumAangemaakt   | TIMESTAMP | 6      | NOT Nullable                   |
| DatumGewijzigd    | TIMESTAMP | 6      | NOT Nullable                   |
