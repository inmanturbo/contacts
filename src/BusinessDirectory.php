<?php

namespace Inmanturbo\ContactsManager;

enum BusinessDirectory: string
{
    use ArrayableEnum;

    case AnimalsAndPets = 'Animals & Pets';
    case Anitiques = 'Anitiques';
    case ArtsAndPhotograph = 'Arts & Photograph';
    case AutomotiveAndParts = 'Automotive & Parts';
    case BusinessAndProfessional = 'Business & Professional';
    case ClothingAndAccessories = 'Clothing & Accessories';
    case CommunityAndGovernment = 'Community & Government';
    case ComputersAndElectronics = 'Computers & Electronics';
    case ConstructionAndContractors = 'Construction & Contractors';
    case EducationAndSchools = 'Education & Schools';
    case Entertainment = 'Entertainment';
    case Equipment = 'Equipment';
    case FinancialAndMortgage = 'Financial & Mortgage';
    case FoodAndDining = 'Food & Dining';
    case GraphicDesignAndPrinting = 'Graphic Design & Printing';
    case HealthAndBeauty = 'Health & Beauty';
    case HomeAndGarden = 'Home & Garden';
    case IndustryAndAgriculture = 'Industry & Agriculture';
    case Insurance = 'Insurance';
    case LegalServices = 'Legal Services';
    case MediaAndCommunications = 'Media & Communications';
    case MedicalDoctorsAndClinics = 'Medical Doctors and Clinics';
    case Music = 'Music';
    case OfficeAndSupplies = 'Office & Supplies';
    case PersonalCareAndServices = 'Personal Care & Services';
    case RealEstate = 'Real Estate';
    case SalonAndSpa = 'Salon and Spa';
    case ShoppingAndRetail = 'Shopping & Retail';
    case SocietyAndCulture = 'Society and Culture';
    case SportsAndRecreation = 'Sports & Recreation';
    case TractorTrailerAndTransport = 'Tractor Trailer & Transport';
    case TravelAndTransportation = 'Travel & Transportation';
    case FuelAndOil = 'Fuel & Oil';
}

// 0c96d6c3-e7bd-40dd-a673-d3057eca59ba,101,Animals & Pets,yes
// ec22cc49-7488-4a0c-b7e7-3ce097968969,102,Anitiques,yes
// c7f7aa2e-f4ef-4622-b61b-e4f40c9a741c,103,Arts & Photograph,yes
// bf414e4d-82ae-415b-8ba1-a89ed9e87900,104,Automotive & Parts,yes
// 2d0d9d77-8aa9-4708-9faa-078419fa3454,105,Business & Professional,yes
// ffafc479-45b3-4cae-939d-ef3abf35b518,106,Clothing & Accessories,yes
// 456048f4-6f98-4f7f-b9ab-45075a18ab49,107,Community & Government,yes
// f0f89f5b-21ea-488c-bf27-b9503480c9a1,108,Computers & Electronics,yes
// 2a6166ab-4f09-4e4e-90b8-735237e32eb0,109,Construction & Contractors,yes
// ddb7c4e4-c32f-48a7-90e7-89ef0f1267d0,110,Education & Schools,yes
// 915f056a-146f-4f1e-9c4d-68a19595fdae,111,Entertainment,yes
// fad99873-8128-4fdf-9b7d-e5ce3ae46447,112,Equipment,yes
// c84945ed-d719-40ed-b7f5-3a1f5488022d,113,Financial & Mortgage,yes
// ffe8ddcd-dcaa-4d20-92d0-189e4c384918,114,Food & Dining,yes
// b23d1bb2-4101-40b1-8af9-823ad0eb3b00,115,Graphic Design & Printing,yes
// 93ca335f-d388-44e8-b2bc-615aa5f9291c,116,Health & Beauty,yes
// a6dab7a8-32e1-4fad-b65f-09df3a5f0b9b,117,Home & Garden,yes
// 4a582200-f38a-4872-876c-71b508544312,118,Industry & Agriculture,yes
// 96dd928c-dfb4-4b32-bc45-eab127c66a06,119,Insurance,yes
// cc51f1bb-faa0-4dae-8d3d-57c8af80f92b,120,Legal Services,yes
// 7995b949-37f3-4eba-90d9-0d7f663ff9c5,121,Media & Communications,yes
// f6ee5c44-2445-4502-80f8-ba75c77982de,122,Medical Doctors and Clinics,yes
// 3a748c47-4ca0-4866-8835-2493cb97f846,123,Music ,yes
// a30b0bc9-0c89-4ffc-bb0a-2628c1d775f4,124,Office & Supplies,yes
// cfd848d9-227e-4e0b-baf0-fa03d7656a5c,125,Personal Care & Services,yes
// 8e726531-2c42-4aef-9e1f-9b6f885c608c,126,Real Estate,yes
// ebc2d41d-e3db-4e1d-8243-ad408eea63d1,127,Salon and Spa,yes
// d697fce5-6f93-4308-ba88-c7693a6a4b01,128,Shopping & Retail,yes
// c0ad3ca4-ea59-4b0d-a317-ec741d36b6bb,129,Society and Culture,yes
// 501992b7-0d12-490c-877e-be8f3085d01f,130,Sports & Recreation,yes
// 31723d3a-7002-4c0a-a1ca-918b23bec50b,131,Tractor Trailer & Transport,yes
// c97c2a2c-3dc0-4e05-8698-576456d14eba,132,Travel & Transportation,yes
// b4d18086-f22c-4a7d-a4c0-cffd29d8a151,133,Fuel & Oil,yes