CREATE TABLE USER (
    userID NUMERIC(8),
    firstName VARCHAR(255),
    lastName VARCHAR(255),
    CONSTRAINT FK_USER FOREIGN KEY USER(userID)
);

CREATE TABLE MEMBER (
    memberID NUMERIC(8),
    adressNumber NUMERIC(6),
    adressStreetType VARCHAR(20),
    adressStreetName VARCHAR(50),
    adressCity VARCHAR(50),
    phone VARCHAR(15),
    CONSTRAINT FK_MEMBER_USER FOREIGN KEY memberID REFERENCES USER(userID)
);

CREATE TABLE CAR (
    carID NUMERIC(8),
    owner NUMERIC(8),
    model VARCHAR(20),
    brand VARCHAR(20),
    year NUMERIC(4),
    capacity NUMERIC(2),
    CONSTRAINT FK_CAR FOREIGN KEY CAR(carID),
    CONSTRAINT FK_CAR_MEMBER FOREIGN KEY owner REFERENCES MEMBER(memberID),
    CONSTRAINT NN_CAR_OWNER CHECK (OWNER IS NOT NULL)
);

CREATE TABLE ROUTE (
    routeID NUMERIC(10),
    departureCity VARCHAR(40),
    arrivalCity VARCHAR(40),
    CONSTRAINT FK_ROUTE FOREIGN KEY ROUTE(routeID)
);

CREATE TABLE TRIP (
    routeID NUMERIC(10),
    carID NUMERIC(8),
    CONSTRAINT PK_TRIP PRIMARY KEY (routeID, carID),
    CONSTRAINT FK_TRIP_ROUTE FOREIGN KEY routeID REFERENCES ROUTE(routeID),
    CONSTRAINT FK_TRIP_CAR FOREIGN KEY carID REFERENCES CAR(carID),
    CONSTRAINT NN_TRIP_ROUTE CHECK (routeID IS NOT NULL),
    CONSTRAINT NN_TRIP_CAR CHECK (carID IS NOT NULL)
);
