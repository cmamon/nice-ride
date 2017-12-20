DELETE FROM TRAVEL;
DELETE FROM TRIP;
DELETE FROM CAR;
DELETE FROM MEMBER;
DELETE FROM ADMIN;
DELETE FROM USER;


-- INSERT VALUES IN USER
INSERT INTO USER VALUES (1, 'Christophe', 'QUENETTE', 1, 'christophe.quenette@etu.umontpellier.fr',
     '$2y$10$ai0LCMpEFzl4EJqyjaTRAuk1KTe41x8g.OGoNErAo5qhn/UArE7f6', 75, 'Avenue',  'Augustin Fliche', 'Montpellier', '+33750867489');
INSERT INTO USER VALUES (2, 'John', 'Doe', 0, 'john.doe@gmail.com',
     '$2y$10$d1McSxc5GCyT33bfU7HIFu..EZONttGgMusXndvY34evFqfPHrDsG', 1, 'Rue', 'de l\'Aiguillerie', 'Montpellier', '+33676767676');


-- INSERT VALUES IN ADMIN
INSERT INTO ADMIN VALUES (1); -- L'utilisateur QUENETTE Christophe est administrateur.

-- INSERT VALUES IN MEMBER
INSERT INTO MEMBER (memberID, birthDate, review) VALUES (2, "1990-12-31", 5.6); -- Test de note trop élévée

-- INSERT VALUES IN CAR
INSERT INTO CAR VALUES (1, 'AA-123-AA', 2, 'Kangoo', 'Renault', 2009, 5);
-- INSERT INTO CAR VALUES (2, 'AA-123-BB', 6, 'Prius', 'Toyota', 2009, 5);

-- INSERT VALUES IN ROUTE
INSERT INTO TRIP VALUES (1, 'Lille, France', 'Montpellier, France', 45);
INSERT INTO TRIP VALUES (2, 'Marseille, France', 'Montpellier, France', 50);
INSERT INTO TRIP VALUES (3, 'Lyon, France', 'Paris, France', 30);
INSERT INTO TRIP VALUES (4, 'Nantes, France', 'Rennes, France', 12);
INSERT INTO TRIP VALUES (5, 'Bordeaux, France', 'Auxerres, France', 17);
INSERT INTO TRIP VALUES (6, 'Maugio, France', 'Toulon, France', 7);
INSERT INTO TRIP VALUES (7, 'Brest, France', 'Versailles, France', 15);
INSERT INTO TRIP VALUES (8, 'Valenciennes, France', 'Narbonne, France', 60);
INSERT INTO TRIP VALUES (9, 'Neuilly-sur-seine, France', 'Le Bourget, France', 5);
INSERT INTO TRIP VALUES (10, 'Fontainebleau, France', 'Millau, France', 35);

-- INSERT VALUES IN TRIP
INSERT INTO TRAVEL VALUES (1, 2, "2017-12-21");
INSERT INTO TRAVEL VALUES (2, 2, "2017-12-22");
INSERT INTO TRAVEL VALUES (3, 2, "2017-12-23");
INSERT INTO TRAVEL VALUES (4, 2, "2017-12-24");
INSERT INTO TRAVEL VALUES (5, 2, "2017-12-25");
INSERT INTO TRAVEL VALUES (6, 2, "2017-12-26");
INSERT INTO TRAVEL VALUES (7, 2, "2017-12-27");
INSERT INTO TRAVEL VALUES (8, 2, "2017-12-28");
INSERT INTO TRAVEL VALUES (9, 2, "2017-12-29");
INSERT INTO TRAVEL VALUES (10, 2, "2017-12-30");
