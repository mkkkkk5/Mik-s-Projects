import db from '../db'
import React, { useState, useEffect } from "react";
import { makeStyles } from "@material-ui/core/styles";
import GridContainer from "../components/Grid/GridContainer.js";
import GridItem from "../components/Grid/GridItem.js";
// import Auction from '../Trixie/Auction'
import ItemBySearch from './ItemBySearch'

import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";
import { useParams } from "react-router-dom";
// import CardHeader from "../components/Card/CardHeader.js";




const useStyles = makeStyles(styles);

export default function SearchedItems() {

  const { searched } = useParams();

 // const { user } = useContext(UserContext)

  const classes = useStyles();

  // const formattedSearch = searched.charAt(0).toUpperCase() 


  
  ////console.log("All Items", allItems)

  const [searchedItems, setSearchedItems] = useState([])
  useEffect(() => db.Users.Items.listenToSearch(setSearchedItems,searched) ,[searched])
  // useEffect(
  //   () => {
  //     const getSearch = async () => {
  //       setSearchedItems(await db.Users.Items.listenToSearch(setSearchedItems,searched))
  //     }
  //     getSearch() 
  //   },[]
  // )
  
  ////console.log("searched text: ", searched)
  //console.log("Searched Items...", searchedItems)

  return (
    <div className={classes.section}>

      <GridContainer justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <h2 className={classes.title}>Current Auctions by Searched: {`${searched}`}</h2>
          {/* {//console.log('boo', searchedItems)} */}
        </GridItem>
      </GridContainer>
      <GridContainer justify="center">
        {/* <ItemBySearch /> */}
        {
          searchedItems.map(item => 
            <ItemBySearch  key={item.id} item={item} {...item}  />
          )
        }
      </GridContainer>
    </div>
  )
}
