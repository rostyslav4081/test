import L, { LatLngExpression } from "leaflet";
import { v4 as uuidv4 } from 'uuid';
import "leaflet/dist/leaflet.css";
import { MapContainer, Marker, TileLayer, Popup } from "react-leaflet";
import React, {useState} from "react";
import {MyMarker} from "../domain/domain";

export default function BasicMap() {
    const[info, setInfo] = useState<boolean>(false)
    const position: LatLngExpression = [49.82893, 18.28259];
    const zoom: number = 15;
    const icon:L.DivIcon = L.divIcon({
        className:"pin",
    });
     const isReady = (event: React.MouseEvent<HTMLButtonElement>) => {
         event.preventDefault();
         if(info === false){
         setInfo (true);
         }else {
             setInfo(false);
         }
         console.log(info);

     };
    const list: MyMarker[] = [
        {
            id:uuidv4(),
            markerName: "Futurum-Ostrava",
            lat: 49.8328,
            lon: 18.2649,
            description:"Department Store"
        },
        {
            id:uuidv4(),
            markerName: "Nemocnice Fifejdy",
            lat: 49.8334,
            lon:  18.27484,
            description:"Hospital"
        },
        {
            id:uuidv4(),
            markerName: "Ostrava střed(Vlaková Stanice)",
            lat: 49.8291088,
            lon: 18.2829285,
            description: "Train station"
        },
    ];
    return (
        <MapContainer center={position} zoom={zoom} scrollWheelZoom={false}>
            <TileLayer
                url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            />
            {
                list.map((item, index) => (
                    <Marker
                        icon={icon}
                        key={index}
                        position={[item.lat, item.lon]}
                        title={`${item.markerName}`}
                    >
                        <Popup>
                            {info&& <div><p> Description: {item.description}</p>
                                <p>ID:<strong>{item.id}</strong></p>
                                <br/>
                                <p>
                                    Lat: <strong>{item.lat}</strong>
                                </p>
                                <p>
                                    Lon: <strong>{item.lon}</strong>
                                </p>
                                <br/></div>}
                            <p>
                                MarkerName:  <strong>{item.markerName}</strong>
                            </p>
                            <button type={'submit'} onClick={isReady}>Deteils</button>
                        </Popup>
                    </Marker>
                ))
            }
        </MapContainer>
    );
}