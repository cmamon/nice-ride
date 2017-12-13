DELETE FROM USER;
DELETE FROM CAR;
DELETE FROM MEMBER;
DELETE FROM ROUTE;
DELETE FROM TRIP;


INSERT INTO USER VALUES (1, 'Christophe', 'QUENETTE', 'christophe.quenette@etu.umontpellier.fr');
INSERT INTO MEMBER VALUES (1, 75, 'Avenue',  'Augustin Fliche', 'Montpellier', '+33750867489', 4.6);
INSERT INTO CAR VALUES (1, 1, 'Kangoo', 'Renault', 2009, 5);
INSERT INTO ROUTE VALUES (1, 'Lille', 'Montpellier');
INSERT INTO TRIP VALUES (1, 1, "2017-12-13");
