import db from '../db'
import React, { useState, useEffect } from "react";
import { makeStyles } from "@material-ui/core/styles";
import GridContainer from "../components/Grid/GridContainer.js";
import GridItem from "../components/Grid/GridItem.js";

import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";
const useStyles = makeStyles(styles);

export default function Profit() {

    const classes = useStyles();


    const [finishedAuctions, setFinishedAuctions] = useState([])
    useEffect(() => db.Auctions.listenTofinished(setFinishedAuctions), [])
    ////console.log(finishedAuctions)
    const profit = finishedAuctions.reduce((total,auction)=>total+auction.currentBid*0.05,0)
    const count = finishedAuctions.length


    return (

        <div
            className={classes.pageHeader}
            style={{
                backgroundImage: "url(https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdSvPg-Xa8Y-dvpsJhWxrZ25RxtEN8xY25Yg&usqp=CAU)",
                backgroundSize: "cover",
                backgroundPosition: "top center"
            }}
        >
            <div className={classes.section}>
                <GridContainer justify="center">
                    <GridItem xs={12} sm={12} md={8}>
                        <h2 className={classes.title} style={{ color: "black" }}>Profit From finished Auctions</h2>
                    </GridItem>
                </GridContainer>
                <GridContainer>
                    <GridItem xs={12} sm={12} md={8}>
                        <h4 className={classes.title} style={{ color: "black" }}>Finished Auction Count: {`${count}`} </h4>
                        <h4 className={classes.title} style={{ color: "black" }}>Profit: {`${profit}`} </h4>

                    </GridItem>
                </GridContainer>
            </div>
        </div>
    )
}
